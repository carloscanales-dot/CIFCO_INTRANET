<template>
  <v-sheet
    elevation="0"
    max-width="500"
    class="mx-auto pa-8 d-flex flex-column align-center justify-center"
    style="min-height: 300px;"
  >
    <v-form @submit.prevent="form.patch(route('profile.update'))" class="w-100 d-flex flex-column align-center">
      <!-- Información del usuario centrada -->
      <div class="d-flex flex-column align-center mb-6 text-center">
        <div class="text-h5 font-weight-bold mb-1">{{ form.name }}</div>
        <div class="text-subtitle-1 text-grey-darken-1">{{ form.email }}</div>
      </div>

      <!-- Aquí podrías agregar más campos del formulario si lo deseas -->

      <!-- Botón de guardar -->
      <!-- <v-btn color="primary" class="mt-4" type="submit">
        Guardar Cambios
      </v-btn> -->
    </v-form>

    <v-divider thickness="2" class="mt-12 w-100" />
  </v-sheet>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'

defineProps({
  mustVerifyEmail: Boolean,
  status: String,
})

const user = usePage().props.auth.user

const form = useForm({
  name: user.name,
  email: user.email,
})
</script>

<style scoped>
.text-grey-darken-1 {
  color: #6b7280; /* Gris elegante y profesional */
}
</style>
