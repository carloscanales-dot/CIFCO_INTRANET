<template>
  <Head title="Formatos" />
  <AuthenticatedLayout id="dashboard-page">
    <v-container class="py-6 py-sm-10" fluid>
      <!-- Sección de Introducción -->
      <v-row justify="center" class="mb-8">
        <v-col cols="12" md="10" lg="8" class="text-center">
          <h1 class="text-h4 text-sm-h3 text-white font-weight-bold mb-3">
            Formatos Institucionales
          </h1>
          <p class="text-body-1 text-sm-h6 text-grey-lighten-2 font-weight-regular">
            Accede y descarga fácilmente todos los documentos y formularios oficiales de CIFCO.
          </p>
        </v-col>
      </v-row>

      <!-- Grid de Formatos -->
      <v-row justify="center" align="stretch" class="px-md-12">
        <v-col v-for="formato in formatos" :key="formato.title" cols="12" sm="6" lg="4">
          <v-card
            class="fill-height d-flex flex-column card-hover"
            elevation="6"
            link
            :href="formato.href"
            target="_blank"
            rounded="xl"
          >
            <div class="text-center pt-6">
              <v-avatar color="primary" size="70">
                <v-icon size="36" color="white">{{ formato.icon }}</v-icon>
              </v-avatar>
            </div>
            <v-card-title class="text-center font-weight-bold text-wrap">
              {{ formato.title }}
            </v-card-title>
            <v-card-text class="text-center text-medium-emphasis flex-grow-1">
              {{ formato.description }}
            </v-card-text>
            <v-card-actions class="justify-center pa-4">
              <v-btn variant="elevated" color="primary" :href="formato.href" target="_blank">
                Descargar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const formatos = [
  {
    title: 'Misión Oficial',
    description: 'Formato utilizado para solicitar una misión oficial y salida por trabajo.',
    href: '/docs/FORMATOS/Formulario mision oficial.pdf',
    icon: 'mdi-file-document-outline',
  },
  {
    title: 'Permisos',
    description: 'Formato utilizado para solicitar permisos para ausencias o licencias.',
    href: '/docs/FORMATOS/Formulario permisos 2025.pdf',
    icon: 'mdi-file-clock-outline',
  },
  {
    title: 'Salida de Equipo',
    description: 'Formato utilizado para solicitar la salida de equipo de la organización.',
    href: '/docs/FORMATOS/FORMATO CONTROL DE SALIDA DE MOBILIARIO Y EQUIPO AF Y AD.xlsx',
    icon: 'mdi-file-export-outline',
  },
];
</script>
<style scoped>
#dashboard-page .v-main {
    position: relative;
    background-color: #3c4557;
}

.card-hover {
  transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.card-hover:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.text-wrap {
  white-space: normal;
}
</style>
