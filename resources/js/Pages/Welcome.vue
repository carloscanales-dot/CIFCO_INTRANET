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
    style="background: #fff; min-height: 100vh;">
  <v-app-bar title="CIFCO INTRANET" app color="primary" dark>
      <v-spacer/>
      <v-btn v-if="canLogin" href="/login" color="secondary" prepend-icon="mdi-login" variant="text">Login</v-btn>
      <v-btn v-if="canRegister" href="/register" color="secondary" prepend-icon="mdi-account" variant="text">Register</v-btn>
    </v-app-bar>
    <v-main>
        <v-container>
          <v-row align="center" justify="center">
            <v-col cols="12" md="6" class="d-flex align-center justify-center">
              <h1 style="color: #1976d2; font-weight: bold; font-size: 2.5rem; text-align: left;">
                Portal de Servicios Institucionales de CIFCO
              </h1>
            </v-col>
            <v-col cols="12" md="6" class="d-flex align-center justify-center">
              <img src="/img/intro-img.svg" alt="Intro" style="max-width: 100%; height: auto;" />
            </v-col>
          </v-row>
        </v-container>
         <v-container class="py-8" fluid>
          <v-row justify="center" class="mb-6">
            <v-col cols="12">
              <h2 style="text-align: center; color: #1976d2; font-weight: bold; font-size: 2rem;">
                Servicios informáticos de CIFCO
              </h2>
            </v-col>
          </v-row>
          <v-row justify="center" align="stretch" class="mb-4">
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4" clickable href="http://localhost:8000/construccion" target="_blank" hover>
                <v-icon size="48" color="primary">mdi-lifebuoy</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Soporte técnico</h3>
                <p>Para agilizar las solicitudes de soporte y brindarle un mejor servicio, utilizamos un sistema de ticket de soporte técnico.</p>
              </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4" href="https://transporte.cifco.gob.sv/users/login" target="_blank" hover>
                <v-icon size="48" color="primary">mdi-truck</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Gestión de Transporte</h3>
                <p>Sistema para la gestión de flotas de vehículos, programación de rutas y seguimiento de envíos.</p>
              </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4" hover clickable href="http://localhost:8000/construccion" target="_blank">
                <v-icon size="48" color="primary">mdi-file-document-multiple</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Sistemas de inventario</h3>
                <p>Software que permite la administración eficiente de inventarios, control de stock y gestión de pedidos.</p>
              </v-card>
            </v-col>
          </v-row>
          <v-row justify="center" align="stretch">
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4" hover clickable href="https://rh.cifco.gob.sv" target="_blank">
                <v-icon size="48" color="primary">mdi-account-group</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Sistema de Recursos humanos</h3>
                <p>Sistema para la gestión de empleados y nómina.</p>
                </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4" hover clickable href="https://marcacion.cifco.gob.sv" target="_blank">
                <v-icon size="48" color="primary">mdi-account-clock</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Sistema de marcación</h3>
                <p>Sistema de control de asistencias y permisos.</p>
              </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4"  hover clickable href="https://bistro.cifco.gob.sv" target="_blank">
                <v-icon size="48" color="primary">mdi-hamburger</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Sistema de banquetes</h3>
                <p>Sistema de control de banquetes y eventos.</p>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
    </v-main>
  </v-app>
</template>
