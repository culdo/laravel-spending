<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Spending from "@/Components/Spending.vue";
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import TextInput from "@/Components/TextInput.vue";

defineProps(['spending']);

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
    <Head title="花費列表" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('spending.store'), { onSuccess: () => {if(form.opType=='create'){form.reset()}} })">

                <div class="flex items-center justify-center">
                    📆 <TextInput name="date" v-model="form.date" type="date" />
                    <InputError class="mt-2" :message="form.errors.date" />

                    <TextInput name="kind" class="ml-2" list="kind" placeholder="蝦款..." v-model="form.kind" />
                    <InputError class="mt-2" :message="form.errors.kind" />

                    <datalist id="kind">
                        <option>早午餐</option>
                        <option>晚餐</option>
                    </datalist>
                </div>

                <div class="flex items-center justify-center mt-2">
                    🛒 <TextInput name="name" type="text" placeholder="吃啥買啥...🌭🥪🍺" v-model="form.name"/>
                    <TextInput name="info" class="ml-2" type="text" placeholder="備註..." v-model="form.info"/>📝
                </div>

                <div class="flex items-center justify-center mt-2">
                    🤳 <TextInput name="image" type="text" placeholder="沒圖沒真相..." v-model="form.image"/>
                    <InputError class="mt-2" :message="form.errors.image" />
                    <TextInput name="cost" class="ml-2" type="text" placeholder="噴多少錢..." v-model="form.cost"/>💰
                </div>

                <div class="flex items-center justify-center mt-4">
                    <PrimaryButton @click="form.opType='search'">🔍 搜尋</PrimaryButton>
                    <PrimaryButton class="ml-2" @click="form.opType='create'">💸 新增花費</PrimaryButton>
                    <PrimaryButton class="ml-2" @click="form.opType='whatToEat'" >🎲 要吃啥</PrimaryButton>
                </div>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Spending
                    v-for="item in spending"
                    :key="item.id"
                    :spending-item="item"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
