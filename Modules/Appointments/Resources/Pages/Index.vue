<template>
    <ConfirmDialog></ConfirmDialog>

    <Head title="Doctors" />
    <AppLayout>
        <template #header>
            <div class="p-2">
                <div>
                    <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Appointments</span>
                    <span class="h-fit min-h-full flex justify-end" style="margin-top: -24px;">
                        <a href="/appointments/create">
                            <PrimaryButton class="ml-2 float-right" type="button">
                                <i class="pi pi-plus"></i>&nbsp;
                                Add Appointment
                            </PrimaryButton>
                        </a>
                    </span>
                </div>
            </div>
        </template>
        <div class="py-2">
            <div v-if="$page.props.flash.notification" class="alert">
                {{ $page.props.flash.notification }}
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
                                No doctros found.
                            </template>
                            <Column field="patient_name" header="Patient Name" :sortable="true"></Column>
                            <Column field="contact_number" header="Contact Number" :sortable="true"></Column>
                            <Column field="doctor_name" header="Doctor Name" :sortable="true"></Column>
                            <Column field="purpose" header="Purpose" :sortable="true"></Column>
                            <Column field="appointment_time" header="Time" :sortable="true"></Column>
                            <Column header="Status">
                                <template #body="{ data }">
                                    <span :class="'customer-badge status-' + data.status">{{ data.status }}</span>
                                </template>
                            </Column>
                            <Column header="Actions">
                                <template #body="slotProps">
                                    <span>
                                        &nbsp;&nbsp;
                                        <a :href="'appointments/edit/' + slotProps.data.id">
                                            <i class="pi pi-file-edit"></i>
                                        </a>

                                        <!-- <a href="#" @click="delete ('id')"><i class="pi pi-trash"></i></a> -->
                                    </span>
                                </template>
                            </Column>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ConfirmDialog from 'primevue/confirmdialog';
import Button from 'primevue/button';
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import InputText from 'primevue/inputtext';

export default {
    data() {
        return {
            filters: {
                "global": { value: null, matchMode: FilterMatchMode.CONTAINS }
            }
        }
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
        InputText
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