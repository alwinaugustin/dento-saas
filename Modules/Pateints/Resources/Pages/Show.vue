<template>
    <ConfirmDialog></ConfirmDialog>

    <Head title="Patients" />
    <AppLayout>
        <template #header>
            <!-- <div>
                <Breadcrumb :home="home" :model="items" />
            </div> -->
            <div class="p-2">
                <div>
                    <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ patient.name
                    }}</span>
                </div>
            </div>
        </template>
        <div class="py-2">
            <div v-if="$page.props.flash.notification" class="alert">
                {{ $page.props.flash.notification }}
            </div>
            <div class="flex flex-row">
                <div class="basis-1/3">
                    <div class="m-2 p-2">
                        <Card>
                            <template #content>
                                <div class="flex flex-row">
                                    <div class="basis-1/3">
                                        <div class="m-2 font-bold text-gray-700 rounded-full bg-slate-300 flex items-center justify-center font-mono"
                                            style="height: 60px; width: 60px; font-size: 30px;">
                                            {{ patient.name.split(" ").map((n) => n[0]).join("") }}
                                        </div>
                                    </div>
                                    <div class="basis-1/2 mt-3">
                                        <div class="text-lg font-bold"> {{ $page['props']['patient'].name }}</div>
                                        <div>
                                            <span class="text-slate-500">Patient ID:</span>
                                            <span>{{ patient.id }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-3">
                                    <div class="flex flex-row">
                                        <div class="basis-1/2">
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Gender</label>
                                                <div>{{ patient.gender }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Blood Group</label>
                                                <div>{{ patient.blood_group }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Contact Number</label>
                                                <div>{{ patient.contact_number }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Imm. Contact</label>
                                                <div>{{ patient.immediate_contact }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Address</label>
                                                <div>{{ patient.immediate_contact }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">City</label>
                                                <div>{{ patient.city }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Zip</label>
                                                <div>{{ patient.postal_code }}</div>
                                            </div>
                                        </div>
                                        <div class="basis-1/2 gap-2">
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Age</label>
                                                <div>{{ patient.age }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Martial status</label>
                                                <div>{{ patient.marital_status }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Email ID</label>
                                                <div>{{ patient.email_id }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Contact Relation</label>
                                                <div>{{ patient.contact_relation }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">Apartment</label>
                                                <div>{{ patient.address_2 }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <label class="font-bold text-sm">State</label>
                                                <div>{{ patient.state }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </template>
                        </Card>
                    </div>
                </div>
                <div class="basis-2/3">
                    <div class="m-1 p-2">
                        <TabView ref="tabview1">
                            <TabPanel header="Appointments">
                                <div class="m-1" v-for="appointment in patient.appointments">
                                    <Card>
                                        <template #content>
                                            <div class="grid grid-cols-6 sm:grid-cols-6 md:grid-cols-6 gap-4 m-1">
                                                <div class="">
                                                    <label class="text-slate-500 text-sm">Date</label>
                                                    <div class="text-sm">{{ moment(new
                                                        Date(appointment.appointment_time)).format('MM-DD-YYYY') }}</div>
                                                </div>
                                                <div class="">
                                                    <label class="text-slate-500 text-sm">Time</label>
                                                    <div class="text-sm">{{ moment(new
                                                        Date(appointment.appointment_time)).format('hh:mm A') }}</div>
                                                </div>
                                                <div class="">
                                                    <label class="text-slate-500 text-sm">Doctor Name</label>
                                                    <div class="text-sm">{{ appointment.doctor.name }}</div>
                                                </div>
                                                <div class="">
                                                    <label class="text-slate-500 text-sm">Purpose</label>
                                                    <div class="text-sm">{{ appointment.purpose }}</div>
                                                </div>
                                                <div class="">
                                                    <label>&nbsp;</label>
                                                    <div>
                                                        <Badge severity="success">{{ appointment.status }}</Badge>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <label>&nbsp;</label>
                                                    <div>
                                                        <span>
                                                            <a href="#"><i class="pi pi-ellipsis-v" @click="toggle"></i></a>
                                                        </span>
                                                        <Menu ref="menu" :model="items" :popup="true" />
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </Card>
                                </div>
                            </TabPanel>
                            <TabPanel header="Records">
                                <div class="card flex md:justify-content-center">
                                    <!-- <Menu :model="items" /> -->
                                </div>
                                <p>
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                    doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                    veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                    ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                                    Consectetur,
                                    adipisci velit, sed quia non numquam eius modi.
                                </p>
                            </TabPanel>
                        </TabView>
                    </div>
                </div>
            </div>
            <div class="grid grid-flow-col gap-3">
            </div>
            <Dialog v-model:visible="rescheduleVisible" modal header="Reschedule" :style="{ width: '30vw' }">
                <div class="bg-white dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-2 text-gray-900 dark:text-gray-100">
                        <div class="grid grid-col-1 gap-3">
                            <div class="p-2">
                                <div>
                                    <InputLabel for="appointment_time" value="Date and Time" />
                                    <Calendar inputId="appointment_time" v-model="form.appointment_time" :showTime="true"
                                        :showSeconds="false" hourFormat="12" />
                                </div>
                            </div>
                            <div class="p-2">
                                <div>
                                    <InputLabel for="doctor" value="Doctor" />
                                    <Dropdown v-model="form.doctor_id" :options="doctors" optionLabel="name"
                                        optionValue="id" placeholder="Select Doctor" :filter="true" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="flex justify-end">
                                <!-- <SecondaryButton class="ml-2" @click="cancel()">Cancel</SecondaryButton> -->
                                <PrimaryButton class="ml-2" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Reschedule
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </Dialog>
        </div>
    </AppLayout>
</template>
<script>
import InputLabel from '@/Components/InputLabel.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ConfirmDialog from 'primevue/confirmdialog';
import Button from 'primevue/button';
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import InputText from 'primevue/inputtext';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import Card from 'primevue/card';
import Badge from 'primevue/badge';
import moment from 'moment';
import Breadcrumb from 'primevue/breadcrumb';
import Menu from 'primevue/menu';
import Dialog from 'primevue/dialog';
import { ref } from 'vue';
import Calendar from 'primevue/calendar';
import Dropdown from 'primevue/dropdown';

export default {
    data() {
        return {
            filters: {
                "global": { value: null, matchMode: FilterMatchMode.CONTAINS }
            },
            form: {
                appointment_time: null,
                doctor_id: null
            },
            moment: moment,
            rescheduleVisible: false,
            items: [
                {
                    label: 'Reschedule',
                    command: (event) => {
                        this.rescheduleVisible = true
                        console.log();
                        this.form.appointment_time = this.patient.appointments.appointment_time
                        this.form.doctor_id = this.patient.appointments.doctor_id
                    },
                },
                { label: 'Mark Completed' },
                { label: 'Cancel Schedule' },
                { label: 'Generate Bill' },
                { label: 'Set Reminder' },
                { label: 'Send Message' },
            ]
        }
    },
    props: {
        patient: Object,
        doctors: Object,
    },
    components: {
        Head,
        AppLayout,
        DataTable,
        Column,
        PrimaryButton,
        ConfirmDialog,
        Button,
        FilterMatchMode,
        InputText,
        TabView,
        TabPanel,
        Card,
        Badge,
        Breadcrumb,
        Menu,
        Dialog,
        Calendar,
        InputLabel,
        Dropdown
    },
    methods: {
        delete() {
            this.$confirm.require({
                message: 'Are you sure you want to proceed?',
                header: 'Confirmation',
                icon: 'pi pi-exclamation-triangle',
                accept: () => {
                    console.log("HERE");
                    //callback to execute when user confirms the action
                },
                reject: () => {
                    //callback to execute when user rejects the action
                },
                onShow: () => {
                    //callback to execute when dialog is shown
                },
                onHide: () => {
                    //callback to execute when dialog is hidden
                }
            });
        },
        toggle(event) {
            console.log(event)
            this.$refs.menu[0].toggle(event);
        }
    }
}

</script>
<style lang="scss" scoped>
::v-deep(.p-paginator) {
    .p-paginator-current {
        margin-left: auto;
    }
}

::v-deep(.p-progressbar) {
    height: .5rem;
    background-color: #D8DADC;

    .p-progressbar-value {
        background-color: #607D8B;
    }
}

::v-deep(.p-datepicker) {
    min-width: 25rem;

    td {
        font-weight: 400;
    }
}

::v-deep(.p-datatable.p-datatable-customers) {
    .p-datatable-header {
        padding: 1rem;
        text-align: left;
        font-size: 1.5rem;
    }

    .p-paginator {
        padding: 1rem;
    }

    .p-datatable-thead>tr>th {
        text-align: left;
    }

    .p-datatable-tbody>tr>td {
        cursor: auto;
    }

    .p-dropdown-label:not(.p-placeholder) {
        text-transform: uppercase;
    }
}

::v-deep(.p-tabview) {
    .p-tabview-panels {
        background: transparent;
    }

    .p-tabview-nav {
        background: transparent;

        li .p-tabview-nav-link {
            background: transparent;
        }
    }
}

.customer-badge.status-scheduled {
    background-color: #C8E6C9;
    color: #256029;
}
</style>