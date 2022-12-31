<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps(['spendingItem']);
</script>

<template>
    <div v-bind:id="spendingItem.id">
        <div class='relative'>
            <div>
                <span class="text-red-400 border-solid border-red-700 border-2 mr-5"><b>新加入</b></span>
                <a v-bind:id="spendingItem.id"> {{spendingItem.id}} </a>
                <Link class='btn-x' :href="route('spending.destroy', spendingItem.id)" method="delete" as="button">X</Link>
            </div>
            <h3>
                <b>{{ spendingItem.name }}</b>
                <span style='float:right;'>噴<span>{{ spendingItem.cost }}</span>元</span>
            </h3>
            <p>
                <span>{{ spendingItem.kind }}</span>
                <span>{{ spendingItem.info }}</span>
                <span style='float:right;'>
                    <span>{{ spendingItem.date }}</span>
                    <span>  {{ spendingItem.weekday }}</span>
                </span>
            </p>
        </div>
    <img v-bind:src="spendingItem.image" alt='Avatar' style='width:100%'>
    </div>
</template>
