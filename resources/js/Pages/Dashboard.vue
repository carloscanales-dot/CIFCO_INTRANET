<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { ref, computed, onMounted } from 'vue'

const page = usePage()

// Fecha foco y tipo de vista
const focus = ref(new Date().toISOString().slice(0,10))
const type = ref('month')
const typeToLabel = {
  day: 'Día',
  week: 'Semana',
  month: 'Mes',
  '4day': '4 Días'
}

// Calendario y eventos
const calendar = ref(null)
const events = ref([])

// Datos desde Laravel/Inertia
const usuarios = computed(() => page.props.usuarios ?? [])

// Generar eventos de cumpleaños según el año del focus
function getCumpleEventos() {
  const year = new Date(focus.value).getFullYear()
  const evts = usuarios.value.flatMap(u => {
    if (!u.fecha_nacimiento) return []

    const [y, m, d] = u.fecha_nacimiento.split('-')
    const date = new Date(year, parseInt(m) - 1, parseInt(d))
    .toISOString()
    .slice(0, 10)

    const fotoUrl = u.url_foto ? `/pictures/${u.url_foto}` : '/pictures/default_avatar.jpg'


    return [{
      name: u.name,
      start: date,
      end: date,
      color: u.sexo === 'M' ? 'blue' : 'pink',
      usuario: { ...u, url_foto: fotoUrl },
      details: `Cargo: ${u.cargo ?? '-'}<br>Área: ${u.area ?? '-'}`
    }]
  })
  events.value = evts
}

onMounted(() => {
  // Generar eventos iniciales para el rango visible
  if (calendar.value?.parsedStart) {
    updateRange({ start: calendar.value.parsedStart, end: calendar.value.parsedEnd })
  } else {
    getCumpleEventos()
  }
})

// Toolbar
function setToday() {
  focus.value = new Date().toISOString().slice(0,10)
}
function prevMonth() { calendar.value.prev() }
function nextMonth() { calendar.value.next() }

// Evento click en calendario
const selectedEvent = ref({})
const selectedOpen = ref(false)
const selectedElement = ref(null)

function showEvent(nativeEvent, { event }) {
  const open = () => {
    selectedEvent.value = event
    selectedElement.value = nativeEvent.target
    requestAnimationFrame(() => requestAnimationFrame(() => selectedOpen.value = true))
  }
  if (selectedOpen.value) {
    selectedOpen.value = false
    requestAnimationFrame(() => requestAnimationFrame(() => open()))
  } else {
    open()
  }
  nativeEvent.stopPropagation()
}

// Colores de eventos
function getEventColor(event) {
  return event.color
}

// Actualizar rango visible
function updateRange({ start, end }) {
  // Calcular el año según el rango visible (inicio o fin)
  const startYear = new Date(start.date).getFullYear()
  const endYear = new Date(end.date).getFullYear()

  // Si el rango cubre dos años (ej: diciembre 2025 - enero 2026), mostramos ambos
  const years = startYear === endYear ? [startYear] : [startYear, endYear]

  // Regenerar eventos para esos años
  const evts = usuarios.value.flatMap(u => {
    if (!u.fecha_nacimiento) return []

    const [y, m, d] = u.fecha_nacimiento.split('-')
    let eventos = []

    for (const yr of years) {
      const fecha = new Date(yr, parseInt(m) - 1, parseInt(d))
        .toISOString()
        .slice(0, 10)

      const fotoUrl = u.url_foto ? `/pictures/${u.url_foto}` : '/pictures/default_avatar.jpg'

      eventos.push({
        name: u.name,
        start: fecha,
        end: fecha,
        color: u.sexo === 'M' ? 'blue' : 'pink',
        usuario: { ...u, url_foto: fotoUrl },
        details: `Cargo: ${u.cargo ?? '-'}<br>Área: ${u.area ?? '-'}`
      })
    }

    return eventos
  })

  events.value = evts
}


// Click en fecha
function viewDay({ date }) {
  focus.value = date
}
</script>

<template>
  <Head title="Cumpleaños" />

  <AuthenticatedLayout id="dashboard-page">
    <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">Cumpleañeros del mes</h2>
        </template>
    <v-row class="fill-height">
      <v-col>
        <!-- Toolbar -->
        <v-sheet height="64">
          <v-toolbar flat>
            <v-btn class="me-4" color="grey-darken-2" variant="outlined" @click="setToday">
              Hoy
            </v-btn>
            <v-btn color="grey-darken-2" size="small" variant="text" icon @click="prevMonth">
              <v-icon size="small">mdi-chevron-left</v-icon>
            </v-btn>
            <v-btn color="grey-darken-2" size="small" variant="text" icon @click="nextMonth">
              <v-icon size="small">mdi-chevron-right</v-icon>
            </v-btn>

            <v-toolbar-title>{{ focus }}</v-toolbar-title>

            <!-- Menu tipo vista -->
            <v-menu location="bottom end">
              <template v-slot:activator="{ props }">
                <v-btn color="grey-darken-2" variant="outlined" v-bind="props">
                  <span>{{ typeToLabel[type] }}</span>
                  <v-icon end>mdi-menu-down</v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-item @click="type = 'day'">
                  <v-list-item-title>Día</v-list-item-title>
                </v-list-item>
                <v-list-item @click="type = 'week'">
                  <v-list-item-title>Semana</v-list-item-title>
                </v-list-item>
                <v-list-item @click="type = 'month'">
                  <v-list-item-title>Mes</v-list-item-title>
                </v-list-item>
                <v-list-item @click="type = '4day'">
                  <v-list-item-title>4 Días</v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
          </v-toolbar>
        </v-sheet>

        <!-- Calendario -->
        <v-sheet height="600">
          <v-calendar
            ref="calendar"
            v-model="focus"
            :event-color="getEventColor"
            :events="events"
            :type="type"
            color="primary"
            @change="updateRange"
            @click:date="viewDay"
            @click:event="showEvent"
          ></v-calendar>

          <!-- Popover para evento -->
          <v-menu
            v-model="selectedOpen"
            :activator="selectedElement"
            :close-on-content-click="false"
            location="end"
          >
            <v-card color="grey-lighten-4" min-width="350px" flat>
              <v-toolbar :color="selectedEvent.color" dark>
                <v-toolbar-title>{{ 'FELIZ CUMPLEAÑOS! 🎂' }}</v-toolbar-title>
              </v-toolbar>
              <v-card-text class="text-center">
                <v-avatar size="100" class="mb-2">
                  <v-img :src="selectedEvent.usuario?.url_foto || '/pictures/default_avatar.jpg'" />
                </v-avatar>
                <div><strong>{{ selectedEvent.usuario?.name }}</strong></div>
                <div>{{ selectedEvent.usuario?.cargo?.nombre }}</div>
                <div>{{ selectedEvent.usuario?.area?.nombre }}</div>
              </v-card-text>
              <v-card-actions>
                <v-btn color="secondary" variant="text" @click="selectedOpen=false">Cerrar</v-btn>
              </v-card-actions>
            </v-card>
          </v-menu>
        </v-sheet>
      </v-col>
    </v-row>
  </AuthenticatedLayout>
</template>

<style>
#dashboard-page .v-main {
  position: relative;
  background-color: #3c4557;
}
</style>
