<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

</script>

<template>
    <Head title="Sistemas"/>
   <AuthenticatedLayout>
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
              <v-card class="pa-4 text-center" elevation="4">
                <v-icon size="48" color="primary">mdi-lifebuoy</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Soporte técnico</h3>
                <p>Para agilizar las solicitudes de soporte y brindarle un mejor servicio, utilizamos un sistema de ticket de soporte técnico.</p>
              </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4">
                <v-icon size="48" color="primary">mdi-truck</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Gestión de Transporte</h3>
                <p>Sistema para la gestión de flotas de vehículos, programación de rutas y seguimiento de envíos.</p>
              </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4">
                <v-icon size="48" color="primary">mdi-file-document-multiple</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Gestión Documental</h3>
                <p>Software que permite la automatización de forma eficaz y eficiente la gestión de documentos electrónicos y en papel a lo largo de todo su ciclo de vida, asi como la ubicación fisica del documento.</p>
              </v-card>
            </v-col>
          </v-row>
          <v-row justify="center" align="stretch">
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4">
                <v-icon size="48" color="primary">mdi-account-group</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Sistema de Recursos humanos</h3>
                <p>Sistema para la gestión de empleados, nómina, y procesos relacionados con los recursos humanos.</p>
              </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4">
                <v-icon size="48" color="primary">mdi-account-clock</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Sistema de marcación</h3>
                <p>Sistema de control de asistencias y permisos.</p>
              </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4">
                <v-icon size="48" color="primary">mdi-hamburger</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Sistema de banquetes</h3>
                <p>Sistema de control de banquetes y eventos.</p>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
   </AuthenticatedLayout>
</template>
