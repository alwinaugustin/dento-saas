<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';


defineProps({
    errors: Object,
    id: null
});

let doctor = null;

let form = reactive({
    id: null,
    name: null,
    email: null,
    contact_number: null,
    speciality: null,
    address: null,
    more_info: null
});

if (usePage().props.doctor) {
    doctor = usePage().props.doctor[0];
    form = reactive({
        id: doctor.id ? doctor.id : null,
        email: doctor.email ? doctor.email : null,
        name: doctor.name ? doctor.name : null,
        contact_number: doctor.contact_number ? doctor.contact_number : null,
        address: doctor.address ? doctor.address : null,
        speciality: doctor.speciality ? doctor.speciality : null,
        more_info: doctor.more_info ? doctor.more_info : null
    });
}

const title = doctor ? 'Update' : 'Add';

const submit = () => {
    router.post('/doctors/create', form)
};
const cancel = () => {
    form.reset();
    router.get('/', form)
}
</script>
<template>
    <Head :title="title + ' Doctor'" />
    <AppLayout>
        <template #header>
            <div class="m-1">
                <div>
                    <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ title
                    }} Doctor</span>
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
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="p-2">
                                <div class="grid grid-cols-3 gap-4 m-1">
                                    <div class="col-span-2">
                                        <InputLabel for="name" value="Name" />
                                        <TextInput id="name" type="text" class="mt-1 block w-12" v-model="form.name"
                                            required />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel for="email" value="Email" />
                                        <TextInput id="email" type="text" class="mt-1 block w-12" v-model="form.email"
                                            required />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel for="more_info" value="Contact Number" />
                                        <TextInput id="contact_number" type="text" class="mt-1 block w-12"
                                            v-model="form.contact_number" required />
                                    </div>
                                </div>
                            </div>
                            <div class="p-2">
                                <div class="grid grid-cols-3 gap-4 m-1">
                                    <div class="col-span-2">
                                        <InputLabel for="speciality" value="Speciality" />
                                        <TextInput id="speciality" type="text" class="mt-1 block w-12"
                                            v-model="form.speciality" required />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel for="address" value="Address" />
                                        <TextInput id="address" type="text" class="mt-1 block w-12" v-model="form.address"
                                            required />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel for="more_info" value="More Info" />
                                        <TextInput id="more_info" type="text" class="mt-1 block w-12"
                                            v-model="form.more_info" required />
                                    </div>
                                </div>
                            </div>
                            <div class="p-2">
                                <div class="grid grid-cols-4 gap-6 m-1" style="justify-content: flex-end">
                                    <SecondaryButton class="ml-2" @click="cancel()">Cancel</SecondaryButton>
                                    <PrimaryButton class="ml-2" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        {{ title }} Doctor
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