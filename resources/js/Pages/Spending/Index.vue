<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Spending from "@/Components/Spending.vue";
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import TextInput from "@/Components/TextInput.vue";

defineProps(['spending', 'createdId']);

const form = useForm({
    date: new Date().toISOString().slice(0,10),
    name: null,
    kind: null,
    image: null,
    cost: null,
    info: null,
    opType: null,
});
</script>

<template>
    <Head title="่ฑ่ฒปๅ่กจ" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('spending.store'), { onSuccess: () => {if(form.opType==='create'){form.reset()}} })">

                <div class="flex items-center justify-center">
                    ๐ <TextInput name="date" v-model="form.date" type="date" />
                    <InputError class="mt-2" :message="form.errors.date" />

                    <TextInput name="kind" class="ml-2" list="kind" placeholder="่ฆๆฌพ..." v-model="form.kind" />
                    <InputError class="mt-2" :message="form.errors.kind" />

                    <datalist id="kind">
                        <option>ๆฉๅ้ค</option>
                        <option>ๆ้ค</option>
                    </datalist>
                </div>

                <div class="flex items-center justify-center mt-2">
                    ๐ <TextInput name="name" type="text" placeholder="ๅๅฅ่ฒทๅฅ...๐ญ๐ฅช๐บ" v-model="form.name"/>
                    <TextInput name="info" class="ml-2" type="text" placeholder="ๅ่จป..." v-model="form.info"/>๐
                </div>

                <div class="flex items-center justify-center mt-2">
                    ๐คณ <TextInput name="image" type="text" placeholder="ๆฒๅๆฒ็็ธ..." v-model="form.image"/>
                    <InputError class="mt-2" :message="form.errors.image" />
                    <TextInput name="cost" class="ml-2" type="text" placeholder="ๅดๅคๅฐ้ข..." v-model="form.cost"/>๐ฐ
                </div>

                <div class="flex items-center justify-center mt-4">
                    <PrimaryButton @click="form.opType='search'">๐ ๆๅฐ</PrimaryButton>
                    <PrimaryButton class="ml-2" @click="form.opType='create'">๐ธ ๆฐๅข่ฑ่ฒป</PrimaryButton>
                    <PrimaryButton class="ml-2" @click="form.opType='whatToEat'" >๐ฒ ่ฆๅๅฅ</PrimaryButton>
                </div>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Spending
                    v-for="item in spending"
                    :key="item.id"
                    :spending-item="item"
                    :created-id="createdId"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
