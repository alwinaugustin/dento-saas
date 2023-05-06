<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import Dropdown from 'primevue/dropdown';
import * as states from '../assets/js/states';
import medical_conditions from '../assets/js/medical_conditions';
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import FileUpload from 'primevue/fileupload';
import Textarea from 'primevue/textarea';
import MultiSelect from 'primevue/multiselect';
import { ref } from 'vue';

defineProps({
    errors: Object,
    id: null
});
const patient = usePage().props.patient?.[0];
const form = reactive({
    id: patient?.id || usePage().props.patient_id,
    prefix: patient?.prefix || null,
    name: patient?.name || null,
    gender: patient?.gender || null,
    age: patient?.age || null,
    blood_group: patient?.blood_group || null,
    marital_status: patient?.marital_status || null,
    contact_number: patient?.contact_number || null,
    email_id: patient?.email_id || null,
    immediate_contact: patient?.immediate_contact || null,
    contact_relation: patient?.contact_relation || null,
    address: patient?.address || null,
    address_2: patient?.address_2 || null,
    city: patient?.city || null,
    state: patient?.state || null,
    postal_code: patient?.postal_code || null,
    referred_by: patient?.referred_by || null,
    medical_conditions: patient?.medical_conditions?.split(',') || null,
    additional_info: patient?.additional_info || null,
    patient_file: patient?.patient_file || null
});

const title = patient ? 'Update' : 'Add';

const gender = ref([
    { name: 'Male', value: 'Male' },
    { name: 'Female', value: 'Female' },
    { name: 'Others', value: 'Others' }
]);

const bloodGroups = ref([
    { name: 'O+', value: 'O+' },
    { name: 'O-', value: 'O-' },
    { name: 'A+', value: 'A+' },
    { name: 'A-', value: 'A-' },
    { name: 'B+', value: 'B+' },
    { name: 'B-', value: 'B-' }
]);

const maritalStatus = ref([
    { name: 'Married', value: 'Married' },
    { name: 'Un Married', value: 'Un Married' },
]);

const prefixes = ref([
    { name: 'Mr.', value: 'Mr.' },
    { name: 'Ms.', value: 'Ms.' },
    { name: 'Mrs.', value: 'Mrs.' },
    { name: 'Dr.', value: 'Dr.' }
]);
const { data, errors, post, processing } = useForm({
    ...form,
    // medical_conditions: form.medical_conditions?.split(',') || []
});
const submit = () => {
    router.post('/pateints/create', form)
};
const cancel = () => {
    Object.assign(form, form)
    router.get('/pateints')
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
        <form @submit.prevent="submit" enctype="multipart/form-data">
            <div class="py-1 form_wrapper">
                <div class="bg-white dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-1 text-gray-900 dark:text-gray-100">
                        <div class="p-1">
                            <div class="grid grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-3 gap-4 m-1">
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
                        <div class="p-1">
                            <div class="grid grid-cols-1 md:grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
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
                        <div class="p-1">
                            <div
                                class="grid grid-cols-1 md:grid-cols-2 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
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
                        <div class="p-1">
                            <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
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
                        <div class="p-1">
                            <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
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
                        <div class="p-1">
                            <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-4 m-1">
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
                                    <MultiSelect v-model="form.medical_conditions" :options="medical_conditions"
                                        placeholder="Select" display="chip" class="w-full md:w-36rem" />
                                </div>
                            </div>
                        </div>
                        <div class="p-1">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 m-1">
                                <div class="">
                                    <InputLabel for="address" value="Additional Info" />
                                    <Textarea v-model="form.additional_info" cols="43" class="mt-1" />
                                </div>
                                <div class="">
                                    <InputLabel for="patient_file" value="Upload Medical Record" />
                                    <input
                                        class="relative mt-4 block w-full min-w-0 flex-auto rounded bg-clip-padding py-[0.32rem] px-3 text-lg font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[margin-inline-end:0.75rem] file:[border-inline-end-width:1px] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-[0_0_0_1px] focus:shadow-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100"
                                        type="file" @input="form.patient_file = $event.target.files[0]" />
                                </div>
                            </div>
                        </div>
                        <div class="p-1">
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