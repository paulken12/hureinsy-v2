/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
       
require('./bootstrap');


window.Vue = require('vue');

Vue.use(Toasted);

Vue.use(VueTheMask);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//HRIS
Vue.component('action-management', require('./components/ActionManagement.vue'));
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('employee-form', require('./components/EmployeeForm.vue'));
Vue.component('personnel-form', require('./components/PersonnelForm.vue'));
Vue.component('employee-profile', require('./components/EmployeeProfile.vue'));
Vue.component('address-form', require('./components/AddressForm.vue'));
Vue.component('make-paf', require('./components/MakePaf.vue'));
Vue.component('contact-form', require('./components/ContactForm.vue'));
Vue.component('emergency-form', require('./components/EmergencyForm.vue'));
Vue.component('medical-form', require('./components/MedicalForm.vue'));
Vue.component('experience-form', require('./components/ExperienceForm.vue'));
Vue.component('education-form', require('./components/EducationForm.vue'));
Vue.component('objective-form', require('./components/ObjectiveForm.vue'));
Vue.component('benefit-form', require('./components/BenefitForm.vue'));
Vue.component('reference-form', require('./components/ReferenceForm.vue'));
Vue.component('contract-form', require('./components/ContractForm.vue'));
Vue.component('family-form', require('./components/FamilyForm.vue'));
Vue.component('training-form', require('./components/TrainingForm.vue'));
Vue.component('paf-request-form', require('./components/PafRequestForm.vue'));
Vue.component('paf-evaluation-form', require('./components/PafEvaluationForm.vue'));
Vue.component('paf-returned-form', require('./components/PafReturnedForm.vue'));
Vue.component('paf-approval-form', require('./components/PafApprovalForm.vue'));
Vue.component('paf-confirmation-form', require('./components/PafConfirmationForm.vue'));
Vue.component('paf-view-form', require('./components/PafViewForm.vue'));
//AMS
Vue.component('dtr-table', require('./components/DtrTable.vue'));
Vue.component('holiday-form', require('./components/HolidayForm.vue'));
Vue.component('shift-form', require('./components/ShiftForm.vue'));
Vue.component('schedule-chart', require('./components/ScheduleChart.vue'));
Vue.component('import-raw', require('./components/ImportRaw.vue'));
Vue.component('schedule-form', require('./components/ScheduleForm.vue'));
Vue.component('ob-form', require('./components/OBForm.vue'));
Vue.component('authorize-ob-form', require('./components/AuthorizeOBForm.vue'));
Vue.component('tv-form', require('./components/TVForm.vue'));
Vue.component('authorize-tv-form', require('./components/AuthorizeTVForm.vue'));
Vue.component('cs-form', require('./components/CSForm.vue'));
Vue.component('authorize-cs-form', require('./components/AuthorizeCSForm.vue'));
Vue.component('et-form', require('./components/ETForm.vue'));
Vue.component('authorize-et-form', require('./components/AuthorizeETForm.vue'));
Vue.component('ot-form', require('./components/OTForm.vue'));
Vue.component('authorize-ot-form', require('./components/AuthorizeOTForm.vue'));
Vue.component('import-att', require('./components/ImportAtt.vue'));
Vue.component('att-table', require('./components/AttTable.vue'));
Vue.component('att-task', require('./components/AttTask.vue'));
Vue.component('my-dtr', require('./components/MyDTR.vue'));
Vue.component('sil-form', require('./components/SILForm.vue'));
Vue.component('leave-form', require('./components/LeaveForm.vue'));
//Vue.component('authorize-ot-form', require('./components/AuthorizeOTForm.vue'));

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

            email: [],

            emp_name: '',
            emp_id: '',
        }
    },


    mounted: function () {
        $('#employee-list').DataTable();
        $('#masters-list').DataTable();
        $('#paf-list').DataTable();
        $('#sched-list').DataTable({
            iDisplayLength: 4,
            bLengthChange: false,
        });

        $(document).ready(function($){
            $('.m-money').mask('000,000,000.00', {reverse: true});
            $('.m-date').mask('0000-00-00');
            $('#ben_sss').mask('00-0000000-0')
            $('#ben_pag_ibig').mask('0000-0000-0000')
            $('#ben_philhealth').mask('0000-0000-0000')
            $('#ben_tin').mask('000-000-000')
            $('#payroll_account').mask('000000000000')
        });
 
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

        modalShow(lists){
            $("#request-modal").modal('show');
            this.emp_name = lists.first_name;
            this.emp_id = lists.company_id;
        }
    }
});

   /*     console.log("%cSTOP  %cSTOP", "color: red; font-size:150px;",
         "color: blue; font-size:70px;}");*/
