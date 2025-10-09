<template>
  <v-sheet elevation="0" max-width="500" class="mx-auto pa-6 d-flex flex-column align-center">
    <v-form @submit.prevent="form.patch(route('profile.update'))" class="w-100">

     <div class="d-flex flex-column align-center mb-6">
        <div class="text-h6 font-weight-bold">{{ form.name }}</div>
        <div class="text-body-1 text-grey-darken-1">{{ form.email }}</div>
      </div>

      <!-- <div v-if="mustVerifyEmail && user.email_verified_at === null" class="mb-4">

        <div class="text-body-2 mb-2">
          Your email address is unverified.
          <v-btn variant="text" size="small" @click="$inertia.post(route('verification.send'))">
            Click here to re-send the verification email.
          </v-btn>
        </div>

        <div v-show="status === 'verification-link-sent'" class="text-success text-body-2">
          A new verification link has been sent to your email address.
        </div>

      </div>

      <span v-if="form.recentlySuccessful" class="text-body-2 text-grey-darken-1 ms-4">
        Saved.
      </span> -->

    </v-form>
    <v-divider thickness="2" class="mt-12" />
  </v-sheet>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';

defineProps({
  mustVerifyEmail: Boolean,
  status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
  name: user.name,
  email: user.email,
});
</script>
