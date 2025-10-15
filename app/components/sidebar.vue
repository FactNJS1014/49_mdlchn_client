<template>
    <v-navigation-drawer app permanent color="blue-lighten-5">
        <v-list density="comfortable" nav>
            <v-list-item v-for="m in menu" :key="m.id" :to="m.to" router exact :active="activemenu === m.to"
                @click="toggleMenu(m.to)" active-color="light-blue-darken-4" variant="tonal">
                <template #prepend>
                    <i :class="[m.icon, 'fa-lg']" class="mr-2"></i>
                </template>
                <template #title>
                    <p class="font-semibold text-md">{{ m.label }}</p>
                </template>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>
import { ref, watch } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const activemenu = ref(route.path);

watch(
    () => route.path,
    (newPath) => {
        activemenu.value = newPath;
    }
);

const toggleMenu = (menuPath) => {
    activemenu.value = menuPath;
};

const menu = ref([
    { id: 1, icon: "fa fa-file-alt", to: "/", label: "OPERATOR RECORD" },
    { id: 2, icon: "fa fa-file-alt", to: "/tech_record", label: "TECHNICHIAN RECORD" },
    { id: 3, icon: "fa fa-check-to-slot", to: "/dataApp", label: "DATA APPROVE" },
]);
</script>
