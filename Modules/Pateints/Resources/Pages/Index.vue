<script setup>
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Row from 'primevue/row';
import ColumnGroup from 'primevue/columngroup';

const submit = () => {
    form.post(route('pateints/create'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
<template>
    <Head title="Add Patient" />
    <AppLayout>
        <template #header>
            <div class="grid grid-cols-6 gap-6 m-1">
            <div class="col-span-10">
                <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Patients</span>
            </div>
        </div>
    </template>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="p-3">
                        <DataTable :value="$page['props']['patients']" responsiveLayout="scroll" :paginator="true"
                                paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                                :rows="10" dataKey="id" :rowsPerPageOptions="[10, 25, 50]"
                                currentPageReportTemplate="Showing {first} to {last} of {totalRecords} entries">
                                <Column field="name" header="Name" :sortable="true"></Column>
                                <Column field="gender" header="Gender" :sortable="true"></Column>
                                <Column field="contact_number" header="Contact Number" :sortable="true"></Column>
                                <Column field="email_id" header="Email" :sortable="true"></Column>
                                <Column field="city" header="City" :sortable="true"></Column>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style lang="scss" scoped></style>