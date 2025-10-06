<script setup>
import {Head} from '@inertiajs/vue3';
import {
  VApp,
  VAppBar,
  VContainer,
  VRow,
  VCol,
  VCard,
  VBtn,
  VSpacer
} from 'vuetify/components';

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <Head title="INTRANET"/>
  <v-app
      style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/path/to/your/image.jpg'); background-size: cover; background-position: center; min-height: 100vh;">
  <v-app-bar title="CIFCO INTRANET" app color="primary" dark>
      <v-spacer/>
      <v-btn v-if="canLogin" href="/login" color="secondary" prepend-icon="mdi-login" variant="text">Login</v-btn>
      <v-btn v-if="canRegister" href="/register" color="secondary" prepend-icon="mdi-account" variant="text">Register</v-btn>
    </v-app-bar>
    <v-main>
        <v-container class="fill-height" fluid>
            <v-row align="center" justify="center">
            <v-col cols="12" md="8" lg="6">
                <v-card class="pa-5" elevation="10" style="background: rgba(255, 255, 255, 0.9);">
                <h1 class="text-center mb-4">Welcome to the Laravel Tutorial Application</h1>
                <p class="text-center mb-4">This is a simple application built with Laravel and Vue.js to demonstrate
                    authentication and basic CRUD operations.</p>
                <div class="text-center">
                    <p>Laravel version: {{ laravelVersion }}</p>
                    <p>PHP version: {{ phpVersion }}</p>
                </div>
                </v-card>
            </v-col>
            </v-row>
        </v-container>
    </v-main>
  </v-app>
</template>
