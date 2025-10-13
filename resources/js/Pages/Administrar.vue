<template>
  <Head title="Administrar" />

  <AuthenticatedLayout class="identification-page">
    <v-container class="py-6 py-sm-10" fluid>
      <!-- Sección de Introducción -->
      <v-row justify="center" class="mb-8">
        <v-col cols="12" md="10" lg="8" class="text-center">
          <h1 class="text-h4 text-sm-h3 text-white font-weight-bold mb-3">
            Panel de Administración
          </h1>
          <p class="text-body-1 text-sm-h6 text-grey-lighten-2 font-weight-regular">
            Gestiona usuarios, roles y recursos del sistema desde un solo lugar.
          </p>
        </v-col>
      </v-row>

      <!-- Grid de Paneles -->
      <v-row justify="center" align="stretch">
        <v-col v-for="panel in adminPanels" :key="panel.title" cols="12" sm="6" md="5" lg="4">
          <v-card
            class="fill-height d-flex flex-column card-hover"
            elevation="6"
            link
            rounded="xl"
            @click="goTo(panel.routeName)"
          >
            <div class="text-center pt-6">
              <v-avatar color="primary" size="70">
                <v-icon size="36" color="white">{{ panel.icon }}</v-icon>
              </v-avatar>
            </div>
            <v-card-title class="text-center font-weight-bold text-wrap">
              {{ panel.title }}
            </v-card-title>
            <v-card-text class="text-center text-medium-emphasis flex-grow-1">
              {{ panel.description }}
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const allPanels = [
  {
    title: 'Administrar Usuarios',
    description: 'Crear, editar y modificar roles de usuarios. También puede restablecer las contraseñas de los usuarios.',
    icon: 'mdi-account-group',
    routeName: 'admin.user.management',
    requiredRole: 'Administrador',
  },
  {
    title: 'Asignación de Equipo',
    description: 'Asignar equipo de cómputo a los usuarios. (En construcción)',
    icon: 'mdi-laptop-account',
    routeName: 'admin.asignacion.equipo',
    requiredRole: 'Administrador',
  },
];

const adminPanels = computed(() => {
  const userRoles = page.props.auth.roles || [];
  return allPanels.filter(panel => userRoles.includes(panel.requiredRole));
});

const goTo = (routeName) => {
  router.visit(route(routeName));
};
</script>

<style>
.identification-page .v-main {
  position: relative;
  background-color: #3c4557 !important;
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
