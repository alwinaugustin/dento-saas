<template>
    <ConfirmDialog></ConfirmDialog>

    <Head title="Appointments" />
    <AppLayout>
        <template #header>
            <div class="p-2">
                <div>
                    <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Appointments</span>
                    <div class="grid grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-5 gap-4 mt-4">
                        <div class="p-2">
                            <div
                                class="bg-blue-500 dark:bg-blue-800 overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2">
                                <div class="p-2 text-gray-900 dark:text-gray-100 flex items-center">
                                    <i class="pi pi-calendar mr-2 text-5xl text-white ml-10"></i>
                                </div>
                                <div class="p-2 text-gray-900 dark:text-gray-100 flex flex-col justify-center">
                                    <div class="mb-2">
                                        <span class="text-white">Total</span>
                                    </div>
                                    <div class="text-4xl font-bold text-white">
                                        36
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2">
                                <div class="p-2 text-black-900 dark:text-gray-100 flex flex-col justify-center">
                                    <div class="mb-2">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="text-4xl font-bold text-black">
                                        36
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2">
                                <div class="p-2 text-black-900 dark:text-gray-100 flex flex-col justify-center">
                                    <div class="mb-2">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="text-4xl font-bold text-black">
                                        36
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2">
                                <div class="p-2 text-black-900 dark:text-gray-100 flex flex-col justify-center">
                                    <div class="mb-2">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="text-4xl font-bold text-black">
                                        36
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1">
                                <div class="p-2 text-black-900 dark:text-gray-100 flex flex-col justify-center">
                                    <div class="text-blue-700 text-sm">
                                        <i class="pi pi-calendar mr-2 text-xl ml-10 text-blue-700"></i>
                                        <a href="#" @click="$inertia.visit(route('appointments/create'))">New
                                            Appointment</a>
                                    </div>
                                    <div class="text-blue-700 text-sm mt-3">
                                        <i class="pi pi-user mr-2 text-xl ml-10"></i>
                                        <a href="#" @click="$inertia.visit(route('patients/create'))">New Patient</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="py-2">
            <div v-if="$page.props.flash.message"
                class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <p class="font-bold">{{ $page.props.flash.message }}</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">
                    <div class="p-2">

                        <DataTable :value="$page['props']['appointments']" responsiveLayout="scroll" :paginator="true"
                            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                            :rows="10" dataKey="id" :rowsPerPageOptions="[10, 25, 50]"
                            currentPageReportTemplate="Showing {first} to {last} of {totalRecords} entries"
                            :globalFilterFields="['name', 'patient_name', 'doctor_name', 'contact_number', 'purpose']"
                            v-model:filters="filters" filterDisplay="menu">
                            <template #header>
                                <div class="flex justify-content-right align-items-center">
                                    <span class="p-input-icon-left">
                                        <i class="pi pi-search" />
                                        <InputText v-model="filters['global'].value" placeholder="Search" />
                                    </span>
                                </div>
                            </template>
                            <template #empty>
                                No appointments found.
                            </template>
                            <Column v-for="column in $page['props']['columns']" :key="column.field" :field="column.field"
                                :header="column.header" :sortable="true"></Column>
                            <Column header="Status">
                                <template #body="{ data }">
                                    <span :class="'customer-badge status-' + data.status">{{ data.status }}</span>
                                </template>
                            </Column>
                            <Column header="">
                                <template #body="slotProps">
                                    <div class="">
                                        <label>&nbsp;</label>
                                        <div>
                                            <span>
                                                <a href="#"><i class="pi pi-ellipsis-v"
                                                        @click="toggle($event, slotProps.data.id)"></i></a>
                                            </span>
                                            <Menu ref="menu" :model="items" :popup="true" />
                                        </div>
                                    </div>
                                </template>
                            </Column>
                        </DataTable>
                    </div>
                </div>
            </div>
            <Dialog v-model:visible="rescheduleVisible" modal header="Reschedule" :style="{ width: '30vw' }">
                <form @submit.prevent="submit">
                    <div class="bg-white dark:bg-gray-800 sm:rounded-lg">
                        <div class="p-2 text-gray-900 dark:text-gray-100">
                            <div class="grid grid-col-1 gap-3">
                                <div class="p-2">
                                    <div>
                                        <InputLabel for="appointment_time" value="Date and Time" />
                                        <Calendar inputId="appointment_time" v-model="form.appointment_time"
                                            :showTime="true" :showSeconds="false" hourFormat="12" dateFormat="dd-mm-yy" />
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
                            <input type="hidden" v-model="form.id">
                            <div class="mt-3">
                                <div class="flex justify-end">
                                    <PrimaryButton class="ml-2" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        Reschedule
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </Dialog>
        </div>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ConfirmDialog from 'primevue/confirmdialog';
import Button from 'primevue/button';
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import InputText from 'primevue/inputtext';
import Menu from 'primevue/menu';
import Calendar from 'primevue/calendar';
import Dropdown from 'primevue/dropdown';
import Dialog from 'primevue/dialog';
import moment from 'moment';

export default {
    data() {
        return {
            filters: {
                "global": { value: null, matchMode: FilterMatchMode.CONTAINS }
            },
            form: {
                appointment_time: null,
                doctor_id: null,
                id: null
            },
            rescheduleVisible: false,
            items: [
                {
                    label: 'Cancel',
                    icon: 'pi pi-ban',
                    command: (event) => {
                        this.$confirm.require({
                            message: 'Are you sure you want to proceed?',
                            header: 'Confirmation',
                            icon: 'pi pi-exclamation-triangle',
                            accept: () => {
                                this.cancel(this.selected)
                            }
                        });
                    }
                },
                {
                    label: 'Add Bill',
                    icon: 'pi pi-dollar',
                    command: (event) => {
                        router.get('/appointments/add-bill/' + this.selected.id)
                    }
                },
                {
                    label: 'Mark Completed',
                    icon: 'pi pi-lock',
                    command: (event) => {
                        this.$confirm.require({
                            message: 'Are you sure you want to proceed?',
                            header: 'Confirmation',
                            icon: 'pi pi-exclamation-triangle',
                            accept: () => {
                                this.complete(this.selected)
                            }
                        });
                    },
                },
                {
                    label: 'Reschdule',
                    icon: 'pi pi-calendar-plus',
                    command: (event) => {
                        this.rescheduleVisible = true
                        this.form.appointment_time = this.selected.appointment_time;
                        this.form.doctor_id = this.selected.doctor_id;
                        this.form.id = this.selected.id;
                    },
                },
                {
                    label: 'Patient Details',
                    icon: 'pi pi-eye',
                    command: (event) => {
                        router.get('/pateints/' + this.selected.patient_id)
                    },
                }
            ]
        }
    },
    props: {
        doctors: Object
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
        Menu,
        Calendar,
        Dropdown,
        Dialog
    },
    methods: {
        cancel(id) {
            const payload = {
                'id': this.selected.id,
                'status': 'cancelled'
            }
            this.$inertia.post(route('appointments/update'), payload);
        },
        complete(id) {
            const payload = {
                'id': this.selected.id,
                'status': 'completed'
            }
            this.$inertia.post(route('appointments/update'), payload);
        },
        toggle(event, appointment_id) {
            this.selected = this.$page['props']['appointments'].find((item) => item.id === appointment_id);
            this.$refs.menu.toggle(event);
        },
        create() {
            router.get('/appointments/create')
        },
        submit() {
            this.rescheduleVisible = false;
            this.$inertia.post(route('appointments/update'), this.form);
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

.customer-badge {
    border-radius: 2px;
    padding: .25em .5rem;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: .3px;
}

.customer-badge.status-scheduled {
    background-color: #C8E6C9;
    color: #256029;
}

.customer-badge.status-cancelled {
    background-color: #FFCDD2;
    color: #C63737;
}

.customer-badge.status-completed {
    background-color: #FEEDAF;
    color: #8A5340;
}
</style>