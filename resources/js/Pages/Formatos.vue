<template>
    <Head title="Formatos"/>
   <AuthenticatedLayout>
        <v-container class="py-8" fluid>
          <v-row justify="center" class="mb-6">
            <v-col cols="12">
              <h2 style="text-align: center; color: #1976d2; font-weight: bold; font-size: 2rem;">
                Formatos institucionales de CIFCO
              </h2>
            </v-col>
          </v-row>
          <v-row justify="center" align="stretch" class="mb-4">
       <!-- cards con iconos en los cuales se puede seleccionar un pdf -->
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4" hover clickable href="/storage/formats/Formato_Solicitud_de_Compra.pdf" target="_blank">
                <v-icon size="48" color="primary">mdi-file-document</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Formulario mision oficial</h3>
                <p>Formato utilizado para solicitar permisos de misión oficial y salida por trabajo.</p>
                <VBtn color="primary" href="/docs/FORMATOS/Formulario mision oficial.pdf" target="_blank">Descargar</VBtn>
              </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4" hover clickable href="/storage/formats/Formato_Solicitud_de_Viaticos.pdf" target="_blank">
                <v-icon size="48" color="primary">mdi-file-document</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Formato de Permisos</h3>
                <p>Formato utilizado para solicitar permisos para ausencias o licencias.</p>
                <VBtn color="primary" href="/docs/FORMATOS/Formulario permisos 2025.pdf" target="_blank">Descargar</VBtn>
              </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-card class="pa-4 text-center" elevation="4" hover clickable href="/storage/formats/Formato_Solicitud_de_Permiso.pdf" target="_blank">
                <v-icon size="48" color="primary">mdi-file-document</v-icon>
                <h3 class="mt-3 mb-1" style="color: #1976d2; font-weight: bold;">Formato de salida de equipo</h3>
                <p>Formato utilizado para solicitar la salida de equipo de la organización.</p>
                <VBtn color="primary" href="/docs/FORMATOS/FORMATO CONTROL DE SALIDA DE MOBILIARIO Y EQUIPO AF Y AD.xlsx" target="_blank">Descargar</VBtn>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
   </AuthenticatedLayout>
   </template>
   <script setup>
        import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
        import { Head, usePage } from '@inertiajs/vue3';
        import { ref, computed } from 'vue';
        import { VBtn } from 'vuetify/components';
        const page = usePage()
   </script>
