<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { ref, computed, watch } from 'vue'

const page = usePage()

// --- Dialogo ---
const dialog = ref(false)
const selectedEvent = ref(null)

function handleEventClick({ event }) {
    selectedEvent.value = event
    dialog.value = true
}

// --- Configuración del calendario ---
const type = ref('month')
const types = [
  { title: 'Mes', value: 'month' },
  { title: 'Semana', value: 'week' },
  { title: 'Día', value: 'day' },
  { title: '4 Días', value: '4day' },
]
const mode = ref('stack')
const modes = [
  { title: 'Apilado', value: 'stack' },
  { title: 'Columna', value: 'column' },
]
const weekday = ref([0, 1, 2, 3, 4, 5, 6])
const weekdays = [
  { title: 'Dom - Sáb', value: [0, 1, 2, 3, 4, 5, 6] },
  { title: 'Lun - Dom', value: [1, 2, 3, 4, 5, 6, 0] },
  { title: 'Lun - Vie', value: [1, 2, 3, 4, 5] },
]

const value = ref(new Date().toISOString().slice(0, 10))
const events = ref([])
const calendar = ref(null)
const displayedMonthYear = ref('')

// --- Datos desde Laravel / Inertia ---
const usuarios = computed(() => page.props.usuarios ?? [])

// --- Generar eventos de cumpleaños ---
function getCumpleEventos() {
  const year = new Date(value.value).getFullYear()

  const evts = usuarios.value.flatMap(u => {
    if (!u.fecha_nacimiento) {
      return [] // Omitir usuario si no tiene fecha de nacimiento
    }

    // Se corrige el cálculo de la fecha de cumpleaños para evitar problemas de zona horaria.
    // new Date('YYYY-MM-DD') es interpretado como UTC. Se parsea manualmente para usar la hora local.
    const dateParts = u.fecha_nacimiento.split('-')
    const month = parseInt(dateParts[1], 10) - 1
    const day = parseInt(dateParts[2], 10)
    const cumpleEsteAnio = new Date(year, month, day)

    const color = u.sexo === 'M' ? 'blue' : 'pink'

    const evento = {
      name: `🎂 ${u.name}`, // FIX: v-calendar usa 'title', no 'name'
      start: cumpleEsteAnio,
      end: cumpleEsteAnio,
      color: color,
      timed: false,
    }

    return [evento]
  })

  events.value = evts
}


// Llamar al inicio
getCumpleEventos()

// --- Cuando el rango visible cambia ---
function onCalendarChange({ start, end }) {
  getCumpleEventos()
  // Actualizar el mes y año mostrado para corregir bug de reactividad
  const date = new Date(start.date.replace(/-/g, '/')) // Usar / para evitar problemas de zona horaria
  const month = date.toLocaleString('es-ES', { month: 'long' });
  const year = start.year;
  displayedMonthYear.value = `${month.charAt(0).toUpperCase() + month.slice(1)} ${year}`;
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
  getCumpleEventos()
})
</script>

<template>
  <Head title="Cumpleaños" />

  <AuthenticatedLayout id="dashboard-page">
    <template #header>
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-white">
                Calendario de Cumpleaños 🎉
            </h2>
            <h2 class="text-xl font-semibold leading-tight text-white">
                {{ displayedMonthYear }}
            </h2>
        </div>
    </template>

    <v-container>
      <!-- Barra de control -->
      <v-sheet class="d-flex align-center mb-2" rounded="lg">
        <v-btn class="ma-2" variant="text" icon @click="prevMonth">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>

        <v-select
          v-model="type"
          :items="types"
          item-title="title"
          item-value="value"
          class="ma-2"
          density="comfortable"
          label="Vista"
          variant="outlined"
          hide-details
        />

        <v-select
          v-model="mode"
          :items="modes"
          item-title="title"
          item-value="value"
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
      <v-sheet height="600" rounded="lg">
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
          @click:event="handleEventClick"
          theme="dark"
        />
      </v-sheet>

        <!-- Dialogo de cumpleaños -->
        <v-dialog v-model="dialog" width="auto">
            <v-card>
                <v-card-title>
                    Detalles del Cumpleañero
                </v-card-title>
                <v-card-text v-if="selectedEvent">
                    ¡Feliz cumpleaños para <strong>{{ selectedEvent.name.replace('🎂', '').trim() }}</strong>!
                </v-card-text>
                <v-card-actions>
                    <v-btn color="primary" block @click="dialog = false">Cerrar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
  </AuthenticatedLayout>
</template>
<style>
#dashboard-page .v-main {
    position: relative;
    background-color: #3c4557;
}

</style>
