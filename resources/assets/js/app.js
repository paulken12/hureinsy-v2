
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

Vue.use(Toasted);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('employee-form', require('./components/EmployeeForm.vue'));
Vue.component('personnel-form', require('./components/PersonnelForm.vue'));
Vue.component('import-raw', require('./components/ImportRaw.vue'));
Vue.component('employee-profile', require('./components/EmployeeProfile.vue'));
Vue.component('address-form', require('./components/AddressForm.vue'));
Vue.component('contact-form', require('./components/ContactForm.vue'));
Vue.component('emergency-form', require('./components/EmergencyForm.vue'));
Vue.component('medical-form', require('./components/MedicalForm.vue'));
Vue.component('experience-form', require('./components/ExperienceForm.vue'));
Vue.component('education-form', require('./components/EducationForm.vue'));

const app = new Vue({
    el: '#app',

    props: ['objective', 'profile','address'],

    data: function()
    {
        return{
            isCollapsed: true,
            editObjective: false,
            editAddress: false,
            empObjective: this.objective,

            address_type: ['Present Address', 'Permanent Address'],
            master_address_key: [],
            add_unit_num: [],
            add_block: [],
            add_street_name: [],
            add_subdivision: [],
            add_barangay: [],
            add_city: [],
            add_province: [],
            add_zip_code: [],
        }
    },


    mounted: function () {

        $('#employee-list').DataTable();

        const scrollables = $('.scrollable');
        if (scrollables.length > 0) {
            scrollables.each((index, element) => {
                console.log(element);
                new PerfectScrollbar(element);
            });
        }

        $('.sidebar .sidebar-menu li a').on('click', function () {
            const $this = $(this);

            if ($this.parent().hasClass('open')) {
                $this
                    .parent()
                    .children('.dropdown-menu')
                    .slideUp(200, () => {
                        $this.parent().removeClass('open');
                    });
            } else {
                $this
                    .parent()
                    .parent()
                    .children('li.open')
                    .children('.dropdown-menu')
                    .slideUp(200);

                $this
                    .parent()
                    .parent()
                    .children('li.open')
                    .children('a')
                    .removeClass('open');

                $this
                    .parent()
                    .parent()
                    .children('li.open')
                    .removeClass('open');

                $this
                    .parent()
                    .children('.dropdown-menu')
                    .slideDown(200, () => {
                        $this.parent().addClass('open');
                    });
            }
        });

// Sidebar Activity Class
        const sidebarLinks = $('.sidebar').find('.sidebar-link');

        sidebarLinks
            .each((index, el) => {
                $(el).removeClass('active');
            })
            .filter(function () {
                const href = $(this).attr('href');
                const pattern = href[0] === '/' ? href.substr(1) : href;
                return pattern === (window.location.pathname).substr(1);
            });

        /**
         * Wait untill sidebar fully toggled (animated in/out)
         * then trigger window resize event in order to recalculate
         * masonry layout widths and gutters.
         */
        // $('#sidebar-toggle').click(e => {
        //     e.preventDefault();
        //     setTimeout(() => {
        //         window.dispatchEvent(window.EVENT);
        //     }, 300);
        // });
    },

    methods: {
        mouseHover: function() {
            this.isCollapsed = true;
        },

        updateObjective(){
            alert('updated');

            // axios.patch('/endpoint/'+this.objective,{
            //     empObjective: this.empObjective
            // });
            this.editObjective = false;
        },
        updateAddress(){
            axios.patch('profile/'+this.objective,{
                empObjective: this.empObjective
            });
            this.editObjective = false;
        },
        addressEdit(value){
            this.editAddress = value;
        }
    }
});
