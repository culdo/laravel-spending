<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';

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
                📆 <input v-model="form.date" type="date" style="width: 95px;">
                <input list="kind" placeholder="蝦款..." v-model="form.kind" style="width: 60px;"><br>
                <datalist id="kind">
                    <option value="早午餐">
                    <option value="晚餐">
                </datalist>
                🛒 <input type="text" placeholder="吃啥買啥...🌭🥪🍺" v-model="form.name">
                <input type="text" placeholder="備註..." v-model="form.info">📝<br>
                🤳 <input type="text" placeholder="沒圖沒真相..." v-model="form.image">
                <input type="text" placeholder="噴多少錢..." v-model="form.cost">💰<br>
                <button type="submit" >🔍 搜尋</button>
                <button type="submit" @click="form.post(route('spends.store'), { onSuccess: () => form.reset() })">💸 新增花費</button>
                <button type="submit" >🎲 要吃啥</button>
                <InputError :message="form.errors.message" class="mt-2" />
                <PrimaryButton class="mt-4">Chirp</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
