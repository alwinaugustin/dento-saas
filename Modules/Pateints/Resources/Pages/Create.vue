<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import Dropdown from 'primevue/dropdown';
import * as states from '../assets/js/states';
import * as medical_conditions from '../assets/js/medical_conditions';
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import FileUpload from 'primevue/fileupload';
import Textarea from 'primevue/textarea';
import MultiSelect from 'primevue/multiselect';

defineProps({
    errors: Object,
    id: null
});

let patient = null;

const conditions = [
    { label: "Hyper Tension", value: "Hyper Tension" }
]

let form = reactive({
    id: usePage().props.patient_id,
    prefix: null,
    name: null,
    gender: null,
    age: null,
    blood_group: null,
    marital_status: null,
    contact_number: null,
    email_id: null,
    immediate_contact: null,
    contact_relation: null,
    address: null,
    address_2: null,
    city: null,
    state: null,
    postal_code: null,
    referred_by: null,
    medical_conditions: null,
    additional_info: null
});

if (usePage().props.patient) {
    patient = usePage().props.patient[0];
    form = reactive({
        id: patient.id ? patient.id : null,
        prefix: patient.prefix ? patient.prefix : null,
        name: patient.name ? patient.name : null,
        gender: patient.gender ? patient.gender : null,
        age: patient.age ? patient.age : null,
        blood_group: patient.blood_group ? patient.blood_group : null,
        marital_status: patient.marital_status ? patient.marital_status : null,
        contact_number: patient.contact_number ? patient.contact_number : null,
        email_id: patient.email_id ? patient.email_id : null,
        immediate_contact: patient.immediate_contact ? patient.immediate_contact : null,
        contact_relation: patient.contact_relation ? patient.contact_relation : null,
        address: patient.address ? patient.address : null,
        address_2: patient.address_2 ? patient.address_2 : null,
        city: patient.city ? patient.city : null,
        state: patient.state ? patient.state : null,
        postal_code: patient.postal_code ? patient.postal_code : null,
        referred_by: patient.referred_by ? patient.referred_by : null,
        medical_conditions: patient.medical_conditions ? patient.medical_conditions : null,
        additional_info: patient.additional_info ? patient.additional_info : null
    });
}

const title = patient ? 'Update' : 'Add';

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
    { name: 'Un Married', value: 'unmarried' },
    { name: 'Divorced', value: 'divorced' }
];
const prefixes = [
    { name: 'Ms', value: 'ms' },
    { name: 'Mr.', value: 'mr' },
    { name: 'Mrs.', value: 'mrs' },
    { name: 'Dr.', value: 'mrs' }
];

const submit = () => {
    router.post('/pateints/create', form)
};
const cancel = () => {
    Object.assign(form, form)
    router.get('/pateints')
}
const onUpload = () => {
    console.log("HERE");
}
const addHeader = (event) => {
    console.log(usePage().props);
    event.formData._token = usePage().props.token
}
</script>
<template>
    <Head :title="title + ' Pateint'" />
    <AppLayout>
        <template #header>
            <div class="m-1">
                <div>
                    <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ title
                    }} Patient</span>
                    <div v-if="Object.keys(errors).length">
                        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                            <p v-for="error in errors">{{ error }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <form @submit.prevent="submit">
            <div class="py-2">
                <div class="bg-white dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="p-2">
                            <div class="grid grid-cols-2 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
                                <div>
                                    <InputLabel for="prefix" value="Prefix" />
                                    <Dropdown v-model="form.prefix" :options="prefixes" optionLabel="name"
                                        optionValue="value" placeholder="Select" />
                                </div>
                                <div>
                                    <InputLabel for="name" value="Patient Name" />
                                    <TextInput id="name" type="text" class="mt-1 block w-12" v-model="form.name" required />
                                </div>
                                <div>
                                    <InputLabel for="id" value="Patient ID" />
                                    <TextInput id="id" type="text" class="mt-1 block w-12" v-model="form.id" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="grid grid-cols-2 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
                                <div>
                                    <InputLabel for="prefix" value="Gender" />
                                    <Dropdown v-model="form.gender" :options="gender" optionLabel="name" optionValue="value"
                                        placeholder="Select" />
                                </div>
                                <div>
                                    <InputLabel for="age" value="Age" />
                                    <TextInput id="age" type="text" class="mt-1 block w-12" v-model="form.age" required />
                                </div>
                                <div>
                                    <InputLabel for="blood_group" value="Blood Group" />
                                    <Dropdown v-model="form.blood_group" :options="bloodGroups" optionLabel="name"
                                        optionValue="value" placeholder="Select" />
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="grid grid-cols-4 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
                                <div>
                                    <InputLabel for="id" value="Marital Status" />
                                    <Dropdown v-model="form.marital_status" :options="maritalStatus" optionLabel="name"
                                        optionValue="value" placeholder="Select" />
                                </div>
                                <div class="">
                                    <InputLabel for="contact_number" value="Contact Number" />
                                    <TextInput id="contact_number" type="text" class="mt-1 block w-12"
                                        v-model="form.contact_number" required />
                                </div>
                                <div class="">
                                    <InputLabel for="email_id" value="Email ID" />
                                    <TextInput id="email_id" type="text" class="mt-1 block w-12" v-model="form.email_id"
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="grid grid-cols-4 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
                                <div class="">
                                    <InputLabel for="immediate_contact" value="Immedeate Contact Number" />
                                    <TextInput id="immediate_contact" type="text" class="mt-1 block w-12"
                                        v-model="form.immediate_contact" />
                                </div>
                                <div class="">
                                    <InputLabel for="contact_relation" value="Immedeate Contact Relation" />
                                    <TextInput id="contact_relation" type="text" class="mt-1 block w-12"
                                        v-model="form.contact_relation" />
                                </div>
                                <div class="">
                                    <InputLabel for="address" value="Address" />
                                    <TextInput id="address" type="text" class="mt-1 block w-12" v-model="form.address"
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="grid grid-cols-4 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
                                <div class="">
                                    <InputLabel for="address_2" value="Apartment" />
                                    <TextInput id="address_2" type="text" class="mt-1 block w-12" v-model="form.address_2"
                                        required />
                                    <div class="validation_errors text-red-700 text-sm" v-if="errors.address_2">{{
                                        errors.address_2 }}</div>
                                </div>
                                <div>
                                    <InputLabel for="city" value="City" />
                                    <TextInput id="city" type="text" class="mt-1 block w-12" v-model="form.city" required />

                                </div>
                                <div>
                                    <InputLabel for="state" value="State" />
                                    <Dropdown v-model="form.state" :options="states.default" optionLabel="name"
                                        optionValue="value" placeholder="Select" />
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="grid grid-cols-4 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
                                <div class="">
                                    <InputLabel for="postal_code" value="Postal Code" />
                                    <TextInput id="postal_code" type="text" class="mt-1 block w-12"
                                        v-model="form.postal_code" required />

                                </div>
                                <div class="">
                                    <InputLabel for="referred_by" value="Referred By" />
                                    <TextInput id="referred_by" type="text" class="mt-1 block w-12"
                                        v-model="form.referred_by" required />
                                </div>
                                <div class="">
                                    <InputLabel for="medical_condition" value="Medical Condition" />
                                    <MultiSelect v-model="form.medical_conditions" :options="conditions" />
                                    optionLabel="label" :option-value="value" placeholder="Select" /> -->
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="grid grid-cols-3 md:grid-cols-3 gap-4 m-1">
                                <div class="">
                                    <InputLabel for="address" value="Additional Info" />
                                    <Textarea v-model="form.additional_info" cols="40" />
                                </div>
                                <div class="">
                                    <InputLabel for="patient_file" value="Upload Files" />
                                    <FileUpload mode="basic" name="patient_file" url="/pateints/upload" :multiple="true"
                                        @upload="onUpload" :auto="true" @before-upload="addHeader" />
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="flex justify-end">
                                <SecondaryButton class="ml-2" @click="cancel()">Cancel</SecondaryButton>
                                <PrimaryButton class="ml-2" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    {{ title }} Patient
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </AppLayout>
</template>

<style lang="scss" scoped></style>