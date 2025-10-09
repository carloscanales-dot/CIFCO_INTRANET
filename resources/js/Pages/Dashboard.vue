<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { ref, computed, watch } from 'vue'
import UpdateProfilePic from './Profile/Partials/UpdateProfilePic.vue';

const page = usePage()

// --- Dialogo ---
const dialog = ref(false)
const selectedEvent = ref(null)

function handleEventClick({ event }) {
  console.log('Evento seleccionado:', event)
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
// --- Generar eventos de cumpleaños ---
function getCumpleEventos() {
  const year = new Date(value.value).getFullYear()

  const evts = usuarios.value.flatMap(u => {
    if (!u.fecha_nacimiento) {
      return [] // Omitir usuario si no tiene fecha de nacimiento
    }

    const dateParts = u.fecha_nacimiento.split('-')
    const month = parseInt(dateParts[1], 10) - 1
    const day = parseInt(dateParts[2], 10)
    const cumpleEsteAnio = new Date(year, month, day)

    const color = u.sexo === 'M' ? 'blue' : 'pink'

    const evento = {
      name: `🎂 ${u.name}`,   // usar title, no name
      start: cumpleEsteAnio,
      end: cumpleEsteAnio,
      color,
      timed: false,
      usuario: u  // 👉 aquí pasamos TODO el usuario
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

        <v-select v-model="type" :items="types" item-title="title" item-value="value" class="ma-2" density="comfortable"
          label="Vista" variant="outlined" hide-details />

        <v-select v-model="mode" :items="modes" item-title="title" item-value="value" class="ma-2" density="comfortable"
          label="Modo" variant="outlined" hide-details />

        <v-select v-model="weekday" :items="weekdays" class="ma-2" density="comfortable" label="Días" variant="outlined"
          hide-details item-title="title" item-value="value" />

        <v-spacer></v-spacer>

        <v-btn class="ma-2" variant="text" icon @click="nextMonth">
          <v-icon>mdi-chevron-right</v-icon>
        </v-btn>
      </v-sheet>

      <!-- Calendario principal -->
      <v-sheet height="600" rounded="lg">
        <v-calendar ref="calendar" v-model="value" :type="type" :events="events" :event-color="getEventColor"
          :event-overlap-mode="mode" :event-overlap-threshold="30" :weekdays="weekday" @change="onCalendarChange"
          @click:event="handleEventClick" theme="dark" />
      </v-sheet>

      <!-- Dialogo de cumpleaños -->
      <v-dialog v-model="dialog" max-width="500">
        <template v-slot:default="{ isActive }">
          <v-card rounded="lg">
            <v-card-title class="d-flex justify-center align-center">
              <div class="text-h5 text-medium-emphasis ps-2">
                ¡FELIZ CUMPLEAÑOS! 🎂
              </div>
            </v-card-title>

            <v-divider class="mb-4"></v-divider>

            <v-row justify="center" align="center" class="mb-8">
              <v-col cols="12" sm="6" md="4" class="d-flex justify-center">
                <v-avatar size="160" class="elevation-4 d-flex justify-center align-center">
                  <UpdateProfilePic />
                </v-avatar>
              </v-col>
            </v-row>
            <v-row justify="center" align="center" class="mb-4">
              <v-col cols="12" class="text-center">
                <div class="text-h6 font-weight-bold">
                  Cumpleañero: {{ selectedEvent?.usuario?.name ?? "Nombre no encontrado"}}
                </div>
                <div class="text-subtitle-1 text-grey-darken-1">
                  Cargo: {{ selectedEvent?.usuario?.cargo ?? "Cargo no encontrado"
                  }}
                </div>
                <div class="text-body-2 text-grey-darken-2">
                 Area: {{ selectedEvent?.usuario?.area ?? "Área no encontrada"
                  }}
                </div>
                <div class="text-body-2 text-grey-darken-2">
                  {{ selectedEvent?.usuario?.area }}
                </div>
              </v-col>
            </v-row>

            <v-divider class="mt-2"></v-divider>

            <v-card-actions class="my-2 d-flex justify-center">
              <v-btn class="text-none w-100" color="primary" rounded="xm" text="Aceptar" variant="flat"  
                @click="isActive.value = false"></v-btn>
            </v-card-actions>
          </v-card>
        </template>
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
