<template>
    <div>
        ID: {{ id }}
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const { id } = useRoute().params

const fetchData = async () => {
    const res = await axios.get
}

onMounted(() => {
    fetchData();
})
</script>
