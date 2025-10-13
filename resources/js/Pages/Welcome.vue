<script setup>
import { Head } from '@inertiajs/vue3'

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
})
</script>

<template>

  <Head title="INTRANET" />

  <v-app style="background: linear-gradient(180deg, #2c3342 0%, #3c4557 100%); min-height: 100vh; " >
    <!-- 🔷 Encabezado principal -->
    <!-- 🔷 AppBar elegante -->
    <v-app-bar app color="primary" dark flat>
  <v-container class="d-flex justify-space-between align-center">
    
      <h2 class="text-h6 font-weight-bold">CIFCO INTRANET</h2>
      <v-img
        src="/img/cifco-logo.png"
        alt="CIFCO"
        max-height="80"
        contain
        class="me-3"
      ></v-img>

    <v-btn
      v-if="canLogin"
      href="/login"
      prepend-icon="mdi-login"
      variant="outlined"
      color="white"
      class="mx-1"
    >
      Iniciar Sesión
    </v-btn>
  </v-container>
</v-app-bar>


    <!-- 🌐 Contenido principal -->
    <v-main class="main-with-logo">
      <v-container class="mt-12 mb-8">
        <v-row align="center" justify="center" class="text-center mb-10">
          <v-col cols="12" md="8">
            <h1 class="text-h3 font-weight-bold mb-4" style="color: #ffffff;">
              Portal de Servicios Internos
            </h1>
            <h5 class="text-h6 font-weight-bold mb-4" style="color: #ffffff;">
              INTRANET
            </h5>
            <p class="text-subtitle-1" style="color: #cbd5e1;">
              Accede a los sistemas y plataformas internas del Centro Internacional de Ferias y Convenciones.
            </p>
          </v-col>
        </v-row>

        <!-- 🧩 Sección de servicios -->
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

          <!-- 🧱 Tarjetas -->
          <v-row justify="center" align="stretch" dense>
            <v-col v-for="(service, i) in services" :key="i" cols="12" sm="6" md="4" class="d-flex">
              <v-card class="flex-grow-1 pa-6 text-center hover-elevate" elevation="4" rounded="xl" :href="service.link"
                target="_blank" style="transition: all 0.25s ease-in-out;">
                <v-icon size="52" color="primary">{{ service.icon }}</v-icon>
                <h3 class="mt-3 mb-2 text-h6 font-weight-bold" style="color: #1976d2;">
                  {{ service.title }}
                </h3>
                <p class="text-body-2" style="color: #4b5563;">
                  {{ service.description }}
                </p>
              </v-card>
            </v-col>
          </v-row>
        </v-card>
      </v-container>
    </v-main>

    <!-- ⚙️ Footer -->
   <v-footer class="text-center d-flex flex-column ga-2 py-4" style="background: linear-gradient(180deg, #2c3342 0%, #3c4557 100%)">
    <div class="d-flex ga-3">
      <v-btn
        v-for="social in socialLinks"
        :key="social.icon"
        :icon="social.icon"
        density="comfortable"
        variant="text"
        :href="social.url"
        target="_blank"
      ></v-btn>
    </div>

    <v-divider class="my-2" thickness="2" width="50"></v-divider>

    <div class="text-caption font-weight-regular opacity-60">
      © Derechos de autor Unidad de Informática - cc. Todos los derechos reservados
    </div>

    <v-divider></v-divider>

    <div>
      {{ new Date().getFullYear() }} — <strong>CIFCO</strong>
    </div>
  </v-footer>
  </v-app>
</template>

<script>

// Íconos con sus enlaces
const socialLinks = [
  { icon: 'mdi-facebook', url: 'https://es-la.facebook.com/CIFCOSV/' },
  { icon: 'mdi-twitter', url: 'https://x.com/cifcosv?lang=es' },
  { icon: 'mdi-instagram', url: 'https://www.instagram.com/cifcoelsalvador/?hl=es-la' },
];
export default {
  data() {
    return {
      services: [
        {
          icon: 'mdi-lifebuoy',
          title: 'Soporte Técnico',
          description: 'Gestione tickets y solicitudes de soporte de manera rápida y organizada.',
          link: 'http://localhost:8000/construccion',
        },
        {
          icon: 'mdi-truck',
          title: 'Gestión de Transporte',
          description: 'Administre flotas, rutas y seguimiento de vehículos institucionales.',
          link: 'https://transporte.cifco.gob.sv/users/login',
        },
        {
          icon: 'mdi-file-document-multiple',
          title: 'Sistemas de Inventario',
          description: 'Controle el stock y gestión de inventarios con eficiencia y trazabilidad.',
          link: 'http://localhost:8000/construccion',
        },
        {
          icon: 'mdi-account-group',
          title: 'Recursos Humanos',
          description: 'Acceda al sistema de gestión de empleados, nómina y evaluaciones.',
          link: 'https://rh.cifco.gob.sv',
        },
        {
          icon: 'mdi-account-clock',
          title: 'Marcación de Asistencia',
          description: 'Registre y supervise horarios, permisos y asistencias de personal.',
          link: 'https://marcaciones.cifco.gob.sv',
        },
        {
          icon: 'mdi-hamburger',
          title: 'Sistema de Banquetes',
          description: 'Gestione reservas, eventos y logística del área de banquetes.',
          link: 'https://bistro.cifco.gob.sv',
        },
      ],
    }
  },
}
</script>

<style scoped>
/* 🔹 Fuente global para toda la vista */
* {
  font-family: 'Avenir Roman', sans-serif !important;
}

/* Hover elegante para las tarjetas de servicios */
.hover-elevate:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.35);
  transition: all 0.3s ease-in-out;
}

/* Títulos y textos del AppBar */
.v-app-bar h2 {
  font-family: 'Avenir Roman', sans-serif;
  font-weight: bold;
  font-size: 1.25rem;
}

/* Tarjetas */
.v-card {
  transition: all 0.25s ease-in-out;
}

/* Footer más elegante */
.v-footer {
  backdrop-filter: blur(6px);
  color: #cbd5e1;
}

/* Colores y tipografía para títulos de sección */
h1,
h2,
h3,
h5,
p {
  font-family: 'Avenir Roman', sans-serif;
}

/* Texto descriptivo en tarjetas */
.text-body-2 {
  color: #e0e7ff;
}

</style>
