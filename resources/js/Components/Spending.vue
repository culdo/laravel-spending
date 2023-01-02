<script setup>
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['spendingItem']);
const weekDays = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
const weekDayIndex = new Date(props.spendingItem.date).getDay();
const weekDay = weekDays[weekDayIndex];
</script>

<template>
    <div class="rounded-md bg-amber-200" v-bind:id="spendingItem.id">
        <div class='py-4 px-5 relative'>
            <div>
                <span class="text-red-400 border-solid border-red-700 border-2 mr-2"><b>新加入</b></span>
                <a class="font-medium text-blue-600 dark:text-blue-800 hover:underline" :href="'#' + spendingItem.id"> #{{spendingItem.id}}</a>
                <Link class='rounded-full bg-red-500 float-right w-8 h-8 -top-2 -right-3 relative text-white text-xs' :href="route('spending.destroy', spendingItem.id)" method="delete" as="button">X</Link>
            </div>
            <h3 class="my-2">
                <b>{{ spendingItem.name }}</b>
                <span class="float-right font-bold">噴<span>{{ spendingItem.cost }}</span>元</span>
            </h3>
            <p>
                <span>{{ spendingItem.kind }} {{ spendingItem.info }}</span>
                <span class="float-right">
                    <span>{{ spendingItem.date }} {{weekDay}}</span>
                </span>
            </p>
        </div>
    <img v-bind:src="spendingItem.image" alt='Avatar' style='width:100%'>
    </div>
</template>
