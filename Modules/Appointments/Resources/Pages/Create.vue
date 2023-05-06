<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';
import APIService from '@/Services/APIService';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import Textarea from 'primevue/textarea';

defineProps({
    errors: Object,
    id: null
});

const apiService = new APIService();
let appointment = null;

let form = reactive({
    id: null,
    patient_id: null,
    doctor_id: null,
    contact_number: null,
    gender: null,
    purpose: null,
    appointment_time: null,
    additional_information: null,
    status: 'scheduled'
});

if (usePage().props.appointment) {
    appointment = usePage().props.appointment[0];
    const form = reactive({
        id: appointment.id ?? null,
        patient_id: appointment.patient_id ?? null,
        doctor_id: appointment.doctor_id ?? null,
        contact_number: appointment.patient?.contact_number ?? null,
        gender: appointment.patient?.gender ?? null,
        purpose: appointment.purpose ?? null,
        appointment_time: appointment.appointment_time ?? null,
        additional_information: appointment.additional_information ?? null,
        status: appointment.status ?? null,
    });
}

const title = appointment ? 'Update' : 'Add';

const submit = () => {
    router.post('/appointments/create', form)
};
const cancel = () => {
    Object.assign(form, form)
    router.get('/appointments')
}

const patients = ref([]);
const doctors = ref([]);

const getPatients = () => {
    apiService.getData('/pateints/get').then(({ data }) => (patients.value = data))
};

const getDoctors = () => {
    apiService.getData('/doctors/get').then(({ data }) => (doctors.value = data))
};


getPatients();
getDoctors();

const onPatientChange = (event) => {
    const index = event.value - 1;
    form.patient_id = patients._value[index].id
    form.contact_number = patients._value[index].contact_number
    form.gender = patients._value[index].gender
}
const status = [
    { name: 'Scheduled', value: 'scheduled' },
    { name: 'Cancelled', value: 'cancelled' },
    { name: 'Completed', value: 'completed' }
];

</script>
<template>
    <Head :title="title + ' Appointment'" />
    <AppLayout>
        <template #header>
            <div class="m-1">
                <div>
                    <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ title
                    }} Appointments</span>
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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-1 text-gray-900 dark:text-gray-100">
                        <div class="p-2">
                            <div class="grid grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-4 gap-4 m-1">
                                <div class="">
                                    <InputLabel for="patient_id" value="Patient" />
                                    <Dropdown v-model="form.patient_id" :options="patients" optionLabel="name"
                                        optionValue="id" placeholder="Select Patient" @change="onPatientChange"
                                        :filter="true" />
                                </div>
                                <div class="">
                                    <InputLabel for="patient_id" value="Patient ID" />
                                    <TextInput id="patient_id" type="text" class="mt-1 block w-12" v-model="form.patient_id"
                                        disabled />
                                </div>
                                <div class="">
                                    <InputLabel for="more_info" value="Contact Number" />
                                    <TextInput id="contact_number" type="text" class="mt-1 block w-12"
                                        v-model="form.contact_number" disabled />
                                </div>
                                <div class="">
                                    <InputLabel for="gender" value="Gender" />
                                    <TextInput id="gender" type="text" class="mt-1 block w-12" v-model="form.gender"
                                        disabled />
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="grid grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-4 gap-4 m-1">
                                <div class="">
                                    <InputLabel for="doctor_id" value="Doctor" />
                                    <Dropdown v-model="form.doctor_id" :options="doctors" optionLabel="name"
                                        optionValue="id" placeholder="Select Doctor" :filter="true" />
                                </div>
                                <div class="">
                                    <InputLabel for="purpose" value="Purpose" />
                                    <TextInput id="purpose" type="text" class="mt-1 block w-12" v-model="form.purpose"
                                        required />
                                </div>
                                <div>
                                    <InputLabel for="appointment_time" value="Date and Time" />
                                    <Calendar inputId="appointment_time" v-model="form.appointment_time" :showTime="true"
                                        :showSeconds="false" hourFormat="12" />
                                </div>
                                <div>
                                    <InputLabel for="status" value="Status" />
                                    <Dropdown v-model="form.status" :options="status" optionLabel="name" optionValue="value"
                                        placeholder="Select Status" />
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="grid grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-3 gap-4 m-1">
                                <div class="col-span-12">
                                    <InputLabel for="purpose" value="Additional Info" />
                                    <Textarea v-model="form.additional_information" rows="5" cols="70" />
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="flex justify-end">
                                <SecondaryButton class="ml-2" @click="cancel()">Cancel</SecondaryButton>
                                <PrimaryButton class="ml-2" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    {{ title }} Appointment
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </AppLayout>
</template>