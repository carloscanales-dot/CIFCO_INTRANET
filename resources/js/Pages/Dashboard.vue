<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Dashboard
      </h2>
    </template>

    <v-container>
      <v-row>
        <v-col>
          <v-calendar
            color="primary"
            :weekdays="[0, 1, 2, 3, 4, 5, 6]"
            type="month"
            show-all
            :show-week="false"
            :first-day-of-week="0"
            :events="events"
            @click:date="onDateClick"
          />
        </v-col>
      </v-row>
    </v-container>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

const events = [
  {
    title: 'Reunión con dirección',
    start: '2025-10-10',
    end: '2025-10-10',
    color: 'red',
  },
  {
    title: 'Entrega de informes',
    start: '2025-10-15',
    end: '2025-10-15',
    color: 'green',
  },
]

const onDateClick = (date) => {
  console.log('Fecha seleccionada:', date)
}
</script>
