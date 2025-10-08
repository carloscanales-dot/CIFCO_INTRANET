<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { ref, computed, watch } from 'vue'

const page = usePage()

// --- Configuración del calendario ---
const type = ref('month')
const types = ['month', 'week', 'day', '4day']
const mode = ref('stack')
const modes = ['stack', 'column']
const weekday = ref([0, 1, 2, 3, 4, 5, 6])
const weekdays = [
  { title: 'Dom - Sáb', value: [0, 1, 2, 3, 4, 5, 6] },
  { title: 'Lun - Dom', value: [1, 2, 3, 4, 5, 6, 0] },
  { title: 'Lun - Vie', value: [1, 2, 3, 4, 5] },
]

const value = ref(new Date().toISOString().slice(0, 10))
const events = ref([])
const calendar = ref(null)

// --- Datos desde Laravel / Inertia ---
const usuarios = computed(() => page.props.usuarios ?? [])

// Log para depurar
console.log('🟢 Usuarios desde Inertia:', usuarios.value)

// --- Generar eventos de cumpleaños ---
function getCumpleEventos() {
  const year = new Date(value.value).getFullYear()
  console.log('📅 Generando eventos para el año:', year)

  const evts = usuarios.value.map(u => {
    const fecha = new Date(u.fecha_nacimiento)
    const cumpleEsteAnio = new Date(year, fecha.getMonth(), fecha.getDate(), 0, 0, 0)

    const color = u.sexo === 'M' ? 'pink' : 'blue'

    const evento = {
      name: `🎂 ${u.name}`,
      start: cumpleEsteAnio,
      end: cumpleEsteAnio,
      color: color,
      timed: false,
    }

    console.log('🎈 Evento generado:', evento)
    return evento
  })

  events.value = evts
  console.log('✅ Eventos listos para el calendario:', events.value)
}


// Llamar al inicio
getCumpleEventos()

// --- Cuando el rango visible cambia ---
function onCalendarChange({ start, end }) {
  console.log('📆 Rango visible cambió:', start, end)
  getCumpleEventos()
}

// --- Colores de eventos ---
function getEventColor(event) {
  return event.color
}

// --- Navegación entre meses ---
function nextMonth() {
  calendar.value.next()
}
function prevMonth() {
  calendar.value.prev()
}

// 🔄 Si los usuarios cambian dinámicamente
watch(usuarios, (nuevos) => {
  console.log('🔄 Usuarios actualizados:', nuevos)
  getCumpleEventos()
})
</script>

<template>
  <Head title="Cumpleaños" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Calendario de Cumpleaños 🎉
      </h2>
    </template>

    <v-container>
      <!-- Barra de control -->
      <v-sheet class="d-flex align-center mb-2" tile>
        <v-btn class="ma-2" variant="text" icon @click="prevMonth">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>

        <v-select
          v-model="type"
          :items="types"
          class="ma-2"
          density="comfortable"
          label="Vista"
          variant="outlined"
          hide-details
        />

        <v-select
          v-model="mode"
          :items="modes"
          class="ma-2"
          density="comfortable"
          label="Modo"
          variant="outlined"
          hide-details
        />

        <v-select
          v-model="weekday"
          :items="weekdays"
          class="ma-2"
          density="comfortable"
          label="Días"
          variant="outlined"
          hide-details
          item-title="title"
          item-value="value"
        />

        <v-spacer></v-spacer>

        <v-btn class="ma-2" variant="text" icon @click="nextMonth">
          <v-icon>mdi-chevron-right</v-icon>
        </v-btn>
      </v-sheet>

      <!-- Calendario principal -->
      <v-sheet height="600">
        <v-calendar
          ref="calendar"
          v-model="value"
          :type="type"
          :events="events"
          :event-color="getEventColor"
          :event-overlap-mode="mode"
          :event-overlap-threshold="30"
          :weekdays="weekday"
          @change="onCalendarChange"
        />
      </v-sheet>
    </v-container>
  </AuthenticatedLayout>
</template>
