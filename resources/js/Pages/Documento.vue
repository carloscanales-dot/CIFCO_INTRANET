<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight">Documentos</h2>
    </template>

    <div class="py-6">
      <v-tabs v-model="tabModel" background-color="primary" dark>
        <v-tab value="interna" :class="tabModel === 'interna' ? 'bg-primary text-white' : ''">Normativa Interna</v-tab>
        <v-tab value="externa" :class="tabModel === 'externa' ? 'bg-primary text-white' : ''">Normativa Externa</v-tab>
      </v-tabs>

      <v-tabs-window v-model="tabModel">
        <v-tabs-window-item value="interna">
          <v-container>
            <!-- Outer panels por grupo (Interna) -->
            <v-expansion-panels multiple>
              <v-expansion-panel v-for="grupo in gruposInterna.filter(g => (categoriasPorGrupo[g.id] || []).length > 0)" :key="grupo.id">
                <v-expansion-panel-title class="font-bold">{{ grupo.nombre }}</v-expansion-panel-title>
                <v-expansion-panel-text>
                  <v-expansion-panels multiple>
                    <v-expansion-panel v-for="categoria in categoriasPorGrupo[grupo.id] || []" :key="categoria.id">
                      <v-expansion-panel-title>{{ categoria.nombre }}</v-expansion-panel-title>
                      <v-expansion-panel-text>
                        <v-list dense>
                          <v-list-item v-for="doc in documentosPorCategoria[categoria.id] || []" :key="doc.id" class="pa-0">
                            <v-row align="center" class="ma-0 pa-0" style="display:flex; align-items:center; width:100%;">
                              <v-col cols="10" class="pa-0">
                                <div style="flex:1; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" class="font-semibold">{{ doc.titulo }}</div>
                              </v-col>
                              <v-col cols="2" class="pa-0 text-right" style="white-space:nowrap;">
                                <v-btn small color="primary" @click="verDocumento(doc)">
                                  <v-icon start>mdi-eye</v-icon>
                                  Ver
                                </v-btn>
                              </v-col>
                            </v-row>
                          </v-list-item>
                        </v-list>
                      </v-expansion-panel-text>
                    </v-expansion-panel>
                  </v-expansion-panels>
                </v-expansion-panel-text>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-container>
  </v-tabs-window-item>

  <v-tabs-window-item value="externa">
          <v-container>
            <!-- Outer panels por grupo (Externa) -->
            <v-expansion-panels multiple>
              <v-expansion-panel v-for="grupo in gruposExterna.filter(g => (categoriasPorGrupo[g.id] || []).length > 0)" :key="grupo.id">
                <v-expansion-panel-title class="font-bold">{{ grupo.nombre }}</v-expansion-panel-title>
                <v-expansion-panel-text>
                  <v-expansion-panels multiple>
                    <v-expansion-panel v-for="categoria in categoriasPorGrupo[grupo.id] || []" :key="categoria.id">
                      <v-expansion-panel-title>{{ categoria.nombre }}</v-expansion-panel-title>
                      <v-expansion-panel-text>
                        <v-list dense>
                          <v-list-item v-for="doc in documentosPorCategoria[categoria.id] || []" :key="doc.id" class="pa-0">
                            <v-row align="center" class="ma-0 pa-0" style="display:flex; align-items:center; width:100%;">
                              <v-col cols="10" class="pa-0">
                                <div style="flex:1; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" class="font-semibold">{{ doc.titulo }}</div>
                              </v-col>
                              <v-col cols="2" class="pa-0 text-right" style="white-space:nowrap;">
                                <v-btn small color="primary" @click="verDocumento(doc)">
                                  <v-icon start>mdi-eye</v-icon>
                                  Ver
                                </v-btn>
                              </v-col>
                            </v-row>
                          </v-list-item>
                        </v-list>
                      </v-expansion-panel-text>
                    </v-expansion-panel>
                  </v-expansion-panels>
                </v-expansion-panel-text>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-container>
  </v-tabs-window-item>
  </v-tabs-window>

      <v-dialog v-model="dialog" max-width="900px" persistent>
        <v-card>
          <v-card-title>
            {{ documentoSeleccionado?.titulo }}
            <v-spacer />
            <v-btn icon @click="dialog = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-card-title>

          <v-card-text>
            <iframe
              v-if="documentoSeleccionado"
              :src="documentoSeleccionado.url"
              width="100%"
              height="600px"
              style="border:none;"
            ></iframe>
          </v-card-text>
        </v-card>
      </v-dialog>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Props expected from server: grupos, categorias, documentos
const props = defineProps({
  grupos: { type: Array, default: () => [] },
  categorias: { type: Array, default: () => [] },
  documentos: { type: Array, default: () => [] },
});

const tabModel = ref('interna');
const dialog = ref(false);
const documentoSeleccionado = ref(null);

const categoriasInterna = computed(() => props.categorias.filter(c => {
  // grupo_id 3 y 4 corresponden a interna (derogada/vigente)
  return c.grupo_id === 3 || c.grupo_id === 4;
}));

const categoriasExterna = computed(() => props.categorias.filter(c => {
  return c.grupo_id === 1 || c.grupo_id === 2;
}));

// Agrupar categorias por grupo_id
const categoriasPorGrupo = computed(() => {
  const m = {};
  for (const c of props.categorias) {
    if (!m[c.grupo_id]) m[c.grupo_id] = [];
    m[c.grupo_id].push(c);
  }
  return m;
});

// Grupos (se esperan venir desde props.grupos)
const gruposInterna = computed(() => (props.grupos || []).filter(g => g.tipo === 'interna'));
const gruposExterna = computed(() => (props.grupos || []).filter(g => g.tipo === 'externa'));

const documentosPorCategoria = computed(() => {
  const map = {};
  for (const d of props.documentos) {
    if (!map[d.categoria_id]) map[d.categoria_id] = [];
    map[d.categoria_id].push(d);
  }
  return map;
});

const verDocumento = (doc) => {
  if (!doc) return;
  const url = doc.url || doc.path || '';
  if (url && url.startsWith('/')) {
    documentoSeleccionado.value = { ...doc, url: window.location.origin + url };
  } else {
    documentoSeleccionado.value = doc;
  }
  dialog.value = true;
};
</script>

<style scoped>
.bg-primary { background-color: #1976d2; }
</style>
