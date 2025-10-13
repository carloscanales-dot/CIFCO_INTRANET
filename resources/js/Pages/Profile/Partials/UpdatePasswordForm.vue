<template>
  <v-sheet elevation="0" max-width="500" class="mx-auto pa-6 d-flex flex-column align-center position-relative">
    <!-- Overlay para mensaje de éxito y redirección -->
    <v-overlay v-model="showSuccessOverlay" class="d-flex justify-center align-center" persistent>
      <v-alert type="success" title="Contraseña Actualizada"
        text="Tu contraseña ha sido cambiada. Serás redirigido al inicio de sesión en unos segundos..." border="start" elevation="2"></v-alert>
    </v-overlay>
    <!-- Título -->
    <v-card-title class="justify-center text-h6 mb-1">
      Actualiza tu contraseña
    </v-card-title>   
    <div class="mb-4 text-body-2 text-center">
      Asegúrate de que tu cuenta esté utilizando una contraseña larga y aleatoria para mantenerla segura.
    </div>

    <!-- Formulario -->
    <v-form @submit.prevent="updatePassword" class="w-100">
      <v-text-field v-model="form.current_password" :type="showCurrent ? 'text' : 'password'"
        label="Contraseña Actual" :append-inner-icon="showCurrent ? 'mdi-eye-off' : 'mdi-eye'"
        @click:append-inner="showCurrent = !showCurrent" :error-messages="form.errors.current_password"
        autocomplete="current-password" class="mb-4 w-100" variant="solo" required />

      <v-text-field v-model="form.password" :type="showNew ? 'text' : 'password'" label="Nueva Contraseña"
        :append-inner-icon="showNew ? 'mdi-eye-off' : 'mdi-eye'" @click:append-inner="showNew = !showNew"
        :error-messages="form.errors.password" :rules="passwordRules" autocomplete="new-password" class="mb-4 w-100"
        variant="solo" required />

      <v-text-field v-model="form.password_confirmation" :type="showConfirm ? 'text' : 'password'"
        label="Confirmar Contraseña" :append-inner-icon="showConfirm ? 'mdi-eye-off' : 'mdi-eye'"
        @click:append-inner="showConfirm = !showConfirm" :error-messages="form.errors.password_confirmation"
        :rules="confirmPasswordRules" autocomplete="new-password" class="mb-6 w-100 custom-text-field" variant="solo"
        required />
      <!-- Botón y mensaje -->
      <div class="d-flex align-center">
        <v-btn :loading="form.processing" :disabled="form.processing" color="primary" type="submit" size="large"
          class="w-100">
          Guardar
        </v-btn>
        <span v-if="form.recentlySuccessful" class="text-body-2 text-grey-darken-1 ms-4">
          Guardado.
        </span>
      </div>
    </v-form>

    <v-divider thickness="2" class="mt-12 w-100" />
  </v-sheet>
</template>

<script setup>
import { ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";

const form = useForm({
  current_password: "",
  password: "",
  password_confirmation: "",
});

const showSuccessOverlay = ref(false);
const showCurrent = ref(false);
const showNew = ref(false);
const showConfirm = ref(false);

// Reglas de validación para la contraseña
const passwordRules = [
  v => !!v || 'La contraseña es requerida.',
  v => (v && v.length >= 8) || 'La contraseña debe tener al menos 8 caracteres.',
  v => /[A-Z]/.test(v) || 'Debe contener al menos una mayúscula.',
  v => /[a-z]/.test(v) || 'Debe contener al menos una minúscula.',
  v => /[0-9]/.test(v) || 'Debe contener al menos un número.',
  v => /[^A-Za-z0-9]/.test(v) || 'Debe contener al menos un caracter especial.',
];

const confirmPasswordRules = [
  v => !!v || 'La confirmación es requerida.',
  v => v === form.password || 'Las contraseñas no coinciden.',
];

const updatePassword = () => {
  form.put(route("password.update"), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      showSuccessOverlay.value = true;
      // Espera 3 segundos y luego cierra la sesión
      setTimeout(() => router.post(route('logout')), 3000);
    },
  });
};
</script>
