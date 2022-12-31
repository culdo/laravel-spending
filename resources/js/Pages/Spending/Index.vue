<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    date: null,
    name: null,
    kind: null,
    image: null,
    cost: null,
    info: null,
});
</script>

<template>
    <Head title="花費列表" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent>
                📆 <TextInput v-model="form.date" type="date" />
                <TextInput list="kind" placeholder="蝦款..." v-model="form.kind" /><br>
                <datalist id="kind">
                    <option>早午餐</option>
                    <option>晚餐</option>
                </datalist>
                🛒 <TextInput type="text" placeholder="吃啥買啥...🌭🥪🍺" v-model="form.name"/>
                <TextInput type="text" placeholder="備註..." v-model="form.info"/>📝<br>
                🤳 <TextInput type="text" placeholder="沒圖沒真相..." v-model="form.image"/>
                <TextInput type="text" placeholder="噴多少錢..." v-model="form.cost"/>💰<br>
                <PrimaryButton >🔍 搜尋</PrimaryButton>
                <PrimaryButton @click="form.post(route('spends.store'), { onSuccess: () => form.reset() })">💸 新增花費</PrimaryButton>
                <PrimaryButton >🎲 要吃啥</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
