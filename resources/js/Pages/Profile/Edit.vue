<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue'
import UpdateProfilePic from './Partials/UpdateProfilePic.vue'
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  user: Object,
})
</script>

<template>

  <Head title="Perfil de Usuario" />

  <AuthenticatedLayout id="dashboard-page">
    <v-container fluid class="py-4">
      <v-row>
        <v-col cols="12">
          <v-card elevation="4" rounded="xl" class="pa-4 w-100">
            <v-card-title class="text-center text-h6 font-weight-bold mb-3">
              Perfil de Usuario
            </v-card-title>
            <v-divider class="mb-4"></v-divider>

            <v-row class="d-flex flex-wrap align-stretch" align="stretch">
              <!-- Columna Izquierda -->
              <v-col cols="12" md="6" class="d-flex flex-column align-center">
                <div class="profile-pic-container mb-3 d-flex justify-center">
                  <UpdateProfilePic :photo-url="user?.url_foto" />
                </div>

                <v-card elevation="2" rounded="lg" class="flex-grow-1 w-100 text-center pa-3">
                  <v-card-title class="pa-0 mb-1">
                    <h2 class="text-h6 font-weight-bold mb-1">{{ user?.name }}</h2>
                  </v-card-title>
                  <v-divider class="mb-2"></v-divider>
                  <v-card-text class="pa-0">
                    <p class="mb-1">{{ user?.email }}</p>
                    <p class="text-caption text-grey mb-0">
                      Rol: {{ user?.roles?.[0]?.name || 'Sin rol' }}
                    </p>
                  </v-card-text>
                </v-card>
              </v-col>

              <!-- Columna Derecha -->
              <v-col cols="12" md="6" class="d-flex flex-column align-center">
                <v-card elevation="2" rounded="lg" class="flex-grow-1 w-100 pa-3">
                  <v-card-text class="pa-0">
                    <UpdatePasswordForm />
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
    </v-container>

  </AuthenticatedLayout>
</template>

<style scoped>
#dashboard-page .v-main {
  background-color: #f7f8fa;
}

.v-card {
  background-color: #ffffff;
}

.profile-pic-container {
  width: 180px;
  height: 180px;
  overflow: hidden;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.profile-pic-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border: none !important;
  box-shadow: none !important;
}

@media (min-width: 960px) {
  .v-container {
    max-width: 95%;
  }

  .v-row>.v-col {
    display: flex;
    flex-direction: column;
  }
}
</style>
