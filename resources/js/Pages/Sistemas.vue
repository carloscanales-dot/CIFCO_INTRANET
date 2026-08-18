<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

</script>

<template>
    <Head title="Sistemas"/>
   <AuthenticatedLayout id="dashboard-page">
        <v-container class="py-12">
            <v-card class="py-10 px-6" elevation="10" rounded="xl"
                style="background-color: rgba(255, 255, 255, 0.1); backdrop-filter: blur(6px);">
                <v-row justify="center" class="mb-8">
                    <v-col cols="12" class="text-center">
                        <h2 class="text-h5 font-weight-bold" style="color: #ffffff;">
                            Servicios Informáticos
                        </h2>
                        <v-divider class="my-4" color="white" thickness="2"></v-divider>
                    </v-col>
                </v-row>

                <v-row justify="center" align="stretch" dense>
                    <v-col cols="12" sm="6" md="4" class="d-flex">
                        <v-card class="flex-grow-1 pa-6 text-center hover-elevate" elevation="4" rounded="xl"
                            href="https://intranet.cifco.gob.sv/construccion" target="_blank">
                            <v-icon size="52" color="primary">mdi-lifebuoy</v-icon>
                            <h3 class="mt-3 mb-2 text-h6 font-weight-bold" style="color: #1976d2;">Soporte técnico</h3>
                            <p class="text-body-2">Para agilizar las solicitudes de soporte y brindarle un mejor
                                servicio, utilizamos un sistema de ticket de soporte técnico.</p>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6" md="4" class="d-flex">
                        <v-card class="flex-grow-1 pa-6 text-center hover-elevate" elevation="4" rounded="xl"
                            href="https://transporte.cifco.gob.sv/" target="_blank">
                            <v-icon size="52" color="primary">mdi-truck</v-icon>
                            <h3 class="mt-3 mb-2 text-h6 font-weight-bold" style="color: #1976d2;">Gestión de Transporte
                            </h3>
                            <p class="text-body-2">Sistema para la gestión de flotas de vehículos, programación de
                                rutas y seguimiento de envíos.</p>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6" md="4" class="d-flex">
                        <v-card class="flex-grow-1 pa-6 text-center hover-elevate" elevation="4" rounded="xl"
                            href="https://inventario.cifco.gob.sv/login" target="_blank">
                            <v-icon size="52" color="primary">mdi-file-document-multiple</v-icon>
                            <h3 class="mt-3 mb-2 text-h6 font-weight-bold" style="color: #1976d2;">Sistemas de
                                inventario</h3>
                            <p class="text-body-2">Software que permite la administración eficiente de inventarios,
                                control de stock y gestión de pedidos.</p>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6" md="4" class="d-flex">
                        <v-card class="flex-grow-1 pa-6 text-center hover-elevate" elevation="4" rounded="xl"
                            href="https://rh.cifco.gob.sv" target="_blank">
                            <v-icon size="52" color="primary">mdi-account-group</v-icon>
                            <h3 class="mt-3 mb-2 text-h6 font-weight-bold" style="color: #1976d2;">Recursos humanos
                            </h3>
                            <p class="text-body-2">Sistema para la gestión de empleados y nómina.</p>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6" md="4" class="d-flex">
                        <v-card class="flex-grow-1 pa-6 text-center hover-elevate" elevation="4" rounded="xl"
                            href="https://marcaciones.cifco.gob.sv" target="_blank">
                            <v-icon size="52" color="primary">mdi-account-clock</v-icon>
                            <h3 class="mt-3 mb-2 text-h6 font-weight-bold" style="color: #1976d2;">Sistema de marcación
                            </h3>
                            <p class="text-body-2">Sistema de control de asistencias y permisos.</p>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6" md="4" class="d-flex">
                        <v-card class="flex-grow-1 pa-6 text-center hover-elevate" elevation="4" rounded="xl"
                            href="https://bistro.cifco.gob.sv" target="_blank">
                            <v-icon size="52" color="primary">mdi-hamburger</v-icon>
                            <h3 class="mt-3 mb-2 text-h6 font-weight-bold" style="color: #1976d2;">Sistema de banquetes
                            </h3>
                            <p class="text-body-2">Sistema de control de banquetes y eventos.</p>
                        </v-card>
                    </v-col>
                </v-row>
            </v-card>
        </v-container>
   </AuthenticatedLayout>
</template>
<style>
#dashboard-page .v-main {
    position: relative;
    background: linear-gradient(180deg, #2c3342 0%, #3c4557 100%);
}

.hover-elevate:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.35) !important;
  transition: all 0.3s ease-in-out;
}

.text-body-2 {
  color: #4b5563;
}
</style>
