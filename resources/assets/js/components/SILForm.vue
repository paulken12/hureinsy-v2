<template>
    <div>    
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <small class="lh-1 text-primary">SIL Management</small>
                        </div>
                        <div class="peer">
                            <small class="text-danger">*Note: rows with red highlights are employees that reached a year and needs to reset/add their SIL points</small>
                        </div>
                    </div>
                </div>
                <table id="empSched-list" class="table" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-primary">
                            <th><small>Employee Name</small></th>
                            <th><small>Mandatory Points</small></th>
                            <th><small>Additional Points</small></th>
                            <th><small>Total Points</small></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(lis, index) in list" :class="{'alert-danger': lis.update}">
                            <td><small v-text="lis.name"></small></td>
                            <td>
                                <small v-if="!list[index].edit" v-text="lis.man"></small>
                                <input v-else type="number" v-model="form.man" class="form-control form-control-sm">
                                <small v-if="lis.edit" class="text-danger" v-text="error_msg.man"></small>
                            </td>
                            <td>
                                <small v-if="!list[index].edit" v-text="lis.add"></small>
                                <input v-else type="number" v-model="form.add" class="form-control form-control-sm">
                                <small v-if="lis.edit" class="text-danger" v-text="error_msg.add"></small>
                            </td>
                            <td>
                                <small v-if="!list[index].edit" v-text="lis.tot"></small>
                                <small v-else v-text="sum"></small>
                            </td>
                            <td v-if="!list[index].edit"><button class="btn btn-sm btn-link" @click="edit(index)">Edit</button></td>
                            <td v-else>
                                <button class="btn btn-sm btn-link" @click="update(lis.id, index)"><i class="ti ti-check"></i></button>
                                <button class="btn btn-sm btn-link" @click="edit(index)"><i class="ti ti-close"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

    import moment from 'moment';
    
    export default {
        props: ['sil', 'emp'],

        data: function () {
            return {
                csrf: '',

                list: [],
                err: [],
                error_msg: {
                    man: '',
                    add: '',
                },

                form: new Form({
                    man: '',
                    add: '',
                    tot: '',
                })
            }
        },


        created: function () {
            this.sil.map((s) => {
                this.emp.map((e) => {
                    if(s.emp_id == e.id){
                        this.list.push({
                            id: s.id,
                            company_id: e.company_id,
                            name: e.last_name +', '+ e.first_name +' '+ e.middle_name,
                            man: this.convert(s.man),
                            add: this.convert(s.add),
                            tot: this.convert(parseFloat(s.add) + parseFloat(s.man)),
                            edit: false,
                            update: this.needUpdate(s.update_flag, s.updated_flag),
                        });
                    }
                });
            });

        },

        mounted: function () {
            this.DTB = $('#empSched-list').DataTable({
                iDisplayLength: 4,
                bLengthChange: false,
            });
            this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        },

        computed: {
            sum(){
                var c = (parseFloat(this.form.man ? Math.abs(this.form.man).toFixed(1) : 0) + parseFloat(this.form.add ? Math.abs(this.form.add).toFixed(1) : 0)).toFixed(1);

                return c;
            }
        },

        methods: {
            convert(c){
                if(c){
                    var quo = c/8;
                    return Number(quo).toFixed(1);
                }else{
                    return 0;
                }
            },

            needUpdate(x, y){
                if(x && y){
                    return true;
                }else{   
                    return false;
                }
            },

            edit(i){
                if(!this.list[i].edit){
                    this.list[i].edit = true;
                    this.form.man = this.list[i].man;
                    this.form.add = this.list[i].add;
                }else{
                    this.list[i].edit = false;
                    this.form.man = '';
                    this.form.add = '';
                    this.error_msg.add = "";
                    this.error_msg.man = "";
                }
            },

            validation(){
                this.error_msg.add = "";
                this.error_msg.man = "";
                this.err = [];
                if(!Boolean(String(this.form.add))){
                    this.error_msg.add = "Additional pts is required";
                    this.err.push("1");
                }
                if(!Boolean(String(this.form.man))){
                    this.error_msg.man = "Mandatory pts is required";
                    this.err.push("1");
                }
            },

            update(id, index){
                this.validation();
                if(!this.err.length){
                    this.form.patch('/sil/update/' + id);
                    let toast = this.$toasted.show("Toasted !!", {
                        theme: "bubble",
                        position: "top-right",
                        type: "success",
                    });
                    toast.text("SIL updated.").goAway(5000);
                    this.error_msg.add = "";
                    this.error_msg.man = "";
                    this.list[index].edit = false;
                    this.list[index].update = false;
                    this.list[index].add = Number(this.form.add).toFixed(1);
                    this.list[index].man = Number(this.form.man).toFixed(1);
                    this.list[index].tot = (parseFloat(this.form.man) + parseFloat(this.form.add)).toFixed(1);
                }
            },
        }
    }
</script>
