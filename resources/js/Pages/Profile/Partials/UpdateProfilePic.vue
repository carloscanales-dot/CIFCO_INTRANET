<template>
  <div class="d-flex justify-start relative">
    <!-- Avatar con imagen -->
    <v-avatar
      size="150"
      class="profile-avatar"
    >
      <v-img
        :src="profilePicture"
        cover
        class="object-top"
      >
        <template #error>
          <v-img :src="defaultAvatar" cover class="object-top" />
        </template>
      </v-img>

      <!-- Overlay transparente -->
      <div class="overlay"></div>
    </v-avatar>

    <!-- Input oculto para subir imagen -->
    <input
      type="file"
      ref="fileInput"
      accept="image/*"
      class="d-none"
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const props = defineProps({
  photoUrl: {
    type: String,
    default: null,
  },
})

onMounted(() => {
  console.log('URL de la foto recibida en UpdateProfilePic.vue:', props.photoUrl);
});

const defaultAvatar = '/pictures/default_avatar.jpg'

const profilePicture = computed(() => {
  if (props.photoUrl && props.photoUrl.trim() !== '') {
    // Construye la URL completa para la foto de perfil.
    // Asume que `photoUrl` es solo el nombre del archivo (ej: 'avatar.jpg')
    return `/pictures/${props.photoUrl}`; 
  }
  return defaultAvatar
})

const fileInput = ref(null)
</script>

<style scoped>
.profile-avatar {
  cursor: pointer;
  border: none;
  transition: transform 0.2s ease-in-out;
  position: relative;
  overflow: hidden;
}

.profile-avatar:hover {
  transform: scale(1.05);
}

/* Overlay transparente con efecto hover */
.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  transition: opacity 0.2s ease-in-out;
}

.profile-avatar:hover .overlay {
  opacity: 1;
}

.object-top {
  object-position: top;
  object-fit: cover;
  height: 100%;
  width: 100%;
}
</style>
