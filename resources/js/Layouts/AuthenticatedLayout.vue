<template>
  <v-app>
  <v-app-bar app color="primary" dark>
      <v-btn icon @click="drawer = !drawer" class="me-2">
        <v-icon>mdi-menu</v-icon>
      </v-btn>
      <v-container class="d-flex align-center">
        <Link :href="route('dashboard')" class="me-4">
          <ApplicationLogo class="h-9 w-auto"/>
        </Link>
        <v-spacer/>
        <v-menu>
          <template #activator="{ props }">
            <v-btn v-bind="props" text>
              {{ $page.props.auth.user.name }}
              <v-icon end>mdi-menu-down</v-icon>
            </v-btn>
          </template>
          <v-list>
            <v-list-item prepend-icon="mdi-account" link @click="() => goTo(route('profile.edit'))" title="Profile"/>
            <v-list-item prepend-icon="mdi-logout" title="Logout" link @click="router.post(`/logout`)" color="error"/>
          </v-list>
        </v-menu>
      </v-container>
    </v-app-bar>

    <v-navigation-drawer v-model="drawer" app>
      <v-list>
        <v-list-item link
            @click="() => goTo(route('dashboard'))"
            :active="route().current('dashboard')"
            prepend-icon="mdi-view-dashboard">
          <v-list-item-title>Dashboard</v-list-item-title>
        </v-list-item>
        <v-divider/>
        <v-list-item link
            @click="() => goTo(route('directorio'))"
            :active="route().current('directorio')"
            prepend-icon="mdi-account-group">
          <v-list-item-title>Directorio</v-list-item-title>
        </v-list-item>
        <v-list-item link
            @click="() => goTo(route('documentos'))"
            :active="route().current('documentos')"
            prepend-icon="mdi-file-document">
          <v-list-item-title>Documentos</v-list-item-title>
        </v-list-item>
        <v-list-item link
            @click="() => goTo(route('sistemas'))"
            :active="route().current('sistemas')"
            prepend-icon="mdi-cog">
          <v-list-item-title>Sistemas</v-list-item-title>
        </v-list-item>
        <v-list-item link
            @click="() => goTo(route('formatos'))"
            :active="route().current('formatos')"
            prepend-icon="mdi-file-chart">
          <v-list-item-title>Formatos</v-list-item-title>
        </v-list-item>
        <v-divider/>
        <v-list-item link
            @click="() => goTo(route('profile.edit'))"
            :active="route().current('profile.edit')"
            prepend-icon="mdi-account">
          <v-list-item-title>Profile</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-main>
      <v-container>
        <slot name="header" v-if="$slots.header"/>
        <slot/>
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup>
import {ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import {Link, router} from '@inertiajs/vue3';

const drawer = ref(false);
const goTo = (route) => {
  router.visit(route)
}
const vGoTo = {
  mounted(el, binding) {
    el.addEventListener('click', () => goTo(binding.value));
  },
  unmounted(el) {
    el.removeEventListener('click', () => goTo(binding.value));
  },
};
</script>
