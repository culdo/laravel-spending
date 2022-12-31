<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    date: new Date().toISOString().slice(0,10),
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

                <div class="flex items-center justify-center">
                    📆 <TextInput v-model="form.date" type="date" />
                    <TextInput class="ml-2" list="kind" placeholder="蝦款..." v-model="form.kind" />
                    <datalist id="kind">
                        <option>早午餐</option>
                        <option>晚餐</option>
                    </datalist>
                </div>

                <div class="flex items-center justify-center mt-2">
                    🛒 <TextInput type="text" placeholder="吃啥買啥...🌭🥪🍺" v-model="form.name"/>
                    <TextInput class="ml-2" type="text" placeholder="備註..." v-model="form.info"/>📝
                </div>

                <div class="flex items-center justify-center mt-2">
                    🤳 <TextInput type="text" placeholder="沒圖沒真相..." v-model="form.image"/>
                    <TextInput class="ml-2" type="text" placeholder="噴多少錢..." v-model="form.cost"/>💰
                </div>

                <div class="flex items-center justify-center mt-4">
                    <PrimaryButton >🔍 搜尋</PrimaryButton>
                    <PrimaryButton class="ml-2" @click="form.post(route('spends.store'), { onSuccess: () => form.reset() })">💸 新增花費</PrimaryButton>
                    <PrimaryButton class="ml-2" >🎲 要吃啥</PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
