<template>
    <div id="table">
        <DataTable :value="data" responsiveLayout="scroll" :paginator="true"
            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            :rows="10" dataKey="id" :rowsPerPageOptions="[10, 25, 50]"
            :currentPageReportTemplate="'Showing {first} to {last} of {totalRecords} entries'"
            :globalFilterFields="globalFilterFields" v-model:filters="filters" filterDisplay="menu">
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
            <Column v-for="column in columns" :key="column.field" :field="column.field" :header="column.header"
                :sortable="true"></Column>
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
                                        @click="emitToggle($event, slotProps.data.id)"></i></a>
                            </span>
                            <Menu ref="menu" :model="menuItems" :popup="true" :appendTo="table" />
                        </div>
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputText from 'primevue/inputtext';
import Menu from 'primevue/menu';
import { FilterMatchMode, FilterOperator } from 'primevue/api';

export default {
    components: {
        DataTable,
        Column,
        InputText,
        Menu,
    },
    props: {
        data: {
            type: Array,
            required: true,
        },
        columns: {
            type: Array,
            required: true,
        },
        globalFilterFields: {
            type: Array,
            required: true,
        },
        menuItems: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            filters: {
                "global": { value: null, matchMode: FilterMatchMode.CONTAINS }
            },
            items: [],
        };
    },
    methods: {
        emitToggle(event, id) {
            console.log(event);
            this.$emit('toggle', event, id);
        },
    },
};
</script>
