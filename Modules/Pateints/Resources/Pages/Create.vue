<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dropdown from 'primevue/dropdown';
import * as states from '../assets/js/states';
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from "primevue/button";


defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    prefix: '',
    name: '',
    gender: '',
    age: '',
    blood_group: '',
    marital_status: '',
    contact_number: '',
    email: '',
    imm_contact_number: '',
    imm_contact_relation: '',
    address: '',
    address_2: '',
    city: '',
    state: '',
    postal_code: ''
});

const gender = [
    { name: 'Male', value: 'male' },
    { name: 'Female', value: 'female' },
    { name: 'Others', value: 'others' }
];
const bloodGroups = [
    { name: 'O+', value: 'O+' },
    { name: 'O-', value: 'O-' },
    { name: 'A+', value: 'A+' },
    { name: 'A-', value: 'A-' },
    { name: 'B+', value: 'B+' },
    { name: 'B-', value: 'B-' }
];
const maritalStatus = [
    { name: 'Married', value: 'married' },
    { name: 'Un Married', value: 'un-married' },
    { name: 'Divorced', value: 'divorced' }
];
const prefixes = [
    { name: 'Ms', value: 'ms' },
    { name: 'Mr.', value: 'mr' },
    { name: 'Mrs.', value: 'mrs' },
    { name: 'Dr.', value: 'mrs' }
];

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
                 <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add Patient</span>
                 </div>
            </div>
        </template>
        <form @submit.prevent="submit">
            <div class="py-5">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="p-3">
                                <div class="grid grid-cols-3 gap-6 m-1">
                                    <div class="col-span-2">
                                        <InputLabel for="prefix" value="Prefix" />
                                        <Dropdown v-model="form.prefix" :options="prefixes" optionLabel="name"
                                            optionValue="value" placeholder="Select" />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel for="name" value="Patient Name" />
                                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                            required />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel for="id" value="Patient ID" />
                                        <TextInput id="id" type="text" class="mt-1 block w-full" v-model="id" disabled />
                                    </div>
                                </div>

                            </div>
                            <div class="p-3">
                                <div class="grid grid-cols-4 gap-6 m-1">
                                    <div class="col-span-2">
                                        <InputLabel for="prefix" value="Gender" />
                                        <Dropdown v-model="form.gender" :options="gender" optionLabel="name"
                                            optionValue="value" placeholder="Select" />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel for="age" value="Age" />
                                        <TextInput id="age" type="text" class="mt-1 block w-full" v-model="form.age"
                                            required />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel for="blood_group" value="Blood Group" />
                                        <Dropdown v-model="form.blood_group" :options="bloodGroups" optionLabel="name"
                                            optionValue="value" placeholder="Select" />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel for="id" value="Marital Status" />
                                        <Dropdown v-model="form.marital_status" :options="maritalStatus" optionLabel="name"
                                            optionValue="value" placeholder="Select" />
                                    </div>
                                </div>

                            </div>
                            <div class="p-3">
                                <div class="grid grid-cols-4 gap-6 m-1">
                                    <div class="">
                                        <InputLabel for="contact_number" value="Contact Number" />
                                        <TextInput id="contact_number" type="text" class="mt-1 block w-full"
                                            v-model="form.contact_number" required />
                                    </div>
                                    <div class="">
                                        <InputLabel for="email" value="Email ID" />
                                        <TextInput id="email" type="text" class="mt-1 block w-full" v-model="form.email"
                                            required />
                                    </div>
                                    <div class="col-start-1 col-end-7">
                                        <InputLabel for="imm_contact_number" value="Immedeate Contact Number" />
                                        <TextInput id="imm_contact_number" type="text" class="mt-1 block w-full"
                                            v-model="form.imm_contact_number" />
                                    </div>
                                    <div class="col-start-1 col-end-7">
                                        <InputLabel for="imm_contact_relation" value="Immedeate Contact Relation" />
                                        <TextInput id="imm_contact_relation" type="text" class="mt-1 block w-full"
                                            v-model="form.imm_contact_relation" />
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="grid grid-cols-4 gap-6 m-1">
                                    <div class="">
                                        <InputLabel for="address" value="Address" />
                                        <TextInput id="address" type="text" class="mt-1 block w-full" v-model="form.address"
                                            required />
                                    </div>
                                    <div class="">
                                        <InputLabel for="address_2" value="Apartment" />
                                        <TextInput id="address_2" type="text" class="mt-1 block w-full"
                                            v-model="form.address_2" required />
                                    </div>
                                    <div class="col-start-1 col-end-7">
                                        <InputLabel for="city" value="City" />
                                        <TextInput id="city" type="text" class="mt-1 block w-full" v-model="form.city"
                                            required />
                                    </div>
                                    <div class="col-start-1 col-end-7">
                                        <InputLabel for="state" value="State" />
                                        <Dropdown v-model="form.state" :options="states.default" optionLabel="name"
                                            optionValue="value" placeholder="Select" />
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="grid grid-cols-4 gap-6 m-1">
                                    <div class="">
                                        <InputLabel for="postal_code" value="Postal Code" />
                                        <TextInput id="postal_code" type="text" class="mt-1 block w-full"
                                            v-model="form.postal_code" required />
                                    </div>
                                </div>
                                <div class="grid grid-cols-4 gap-6 m-1">
                                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        Add Patient
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </AppLayout>
</template>

<style lang="scss" scoped></style>