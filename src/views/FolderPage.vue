<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-menu-button color="primary"></ion-menu-button>
        </ion-buttons>
        <ion-title>{{ $route.params.id }}</ion-title>
      </ion-toolbar>
    </ion-header>

    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">{{ $route.params.id }}</ion-title>
        </ion-toolbar>
      </ion-header>

      <div id="container">
        <!-- Página Inicial -->
        <div v-if="currentView === 'Inicio'" class="page-container">
          <ion-card>
            <ion-card-content class="personal-info">
              <div class="photo-container">
                <ion-img 
                  src="./fto2.jpg" 
                  alt="Foto personal"
                  class="profile-photo"
                ></ion-img>
              </div>

              <div class="info-container">
                <h1 class="name">Engel De Jesús Tejada Rodríguez</h1>
                <p class="email">
                  <ion-icon :icon="mailOutline"></ion-icon>
                  engeltejadaxd04@gmail.com
                </p>
                <p class="description">
                  Mat. 2023-0605<br>
                </p>
              </div>
            </ion-card-content>
          </ion-card>
        </div>

        <!-- Sumadora -->
        <div v-else-if="currentView === 'Sumadora'" class="page-container">
          <ion-card>
            <ion-card-header>
              <ion-card-title>Calculadora Sumadora</ion-card-title>
              <ion-card-subtitle>Suma dos números</ion-card-subtitle>
            </ion-card-header>
            <ion-card-content>
              <ion-item>
                <ion-input 
                  v-model.number="num1" 
                  type="number" 
                  placeholder="Ingresa el primer número"
                  label="Primer Número"
                  label-placement="floating"
                  clear-input
                ></ion-input>
              </ion-item>
              
              <ion-item>
                <ion-input 
                  v-model.number="num2" 
                  type="number" 
                  placeholder="Ingresa el segundo número"
                  label="Segundo Número"
                  label-placement="floating"
                  clear-input
                ></ion-input>
              </ion-item>
              
              <ion-button 
                @click="sumar" 
                expand="block" 
                class="ion-margin-top"
                :disabled="num1 === null || num2 === null || num1 === undefined || num2 === undefined"
              >
                <ion-icon :icon="addOutline" slot="start"></ion-icon>
                Sumar
              </ion-button>
              
              <ion-card v-if="resultadoSuma !== null" class="result-card">
                <ion-card-content>
                  <div class="result-display">
                    <h2>{{ num1 }} + {{ num2 }} = {{ resultadoSuma }}</h2>
                  </div>
                </ion-card-content>
              </ion-card>
            </ion-card-content>
          </ion-card>
        </div>
        
        <!-- Traductor de Números a Letras -->
        <div v-else-if="currentView === 'Traductor'" class="page-container">
          <ion-card>
            <ion-card-header>
              <ion-card-title>Traductor de Números a Letras</ion-card-title>
              <ion-card-subtitle>Números del 1 al 1000</ion-card-subtitle>
            </ion-card-header>
            <ion-card-content>
              <ion-item>
                <ion-input 
                  v-model.number="numeroTraducir" 
                  type="number" 
                  placeholder="Ingresa un número (1-1000)"
                  label="Número"
                  label-placement="floating"
                  min="1"
                  max="1000"
                  clear-input
                ></ion-input>
              </ion-item>
              
              <ion-button 
                @click="traducirNumero" 
                expand="block" 
                class="ion-margin-top"
                :disabled="!numeroTraducir || numeroTraducir < 1 || numeroTraducir > 1000"
              >
                <ion-icon :icon="languageOutline" slot="start"></ion-icon>
                Traducir
              </ion-button>
              
              <ion-card v-if="numeroEnLetras" class="result-card">
                <ion-card-content>
                  <div class="result-display">
                    <h3>{{ numeroTraducir }}</h3>
                    <p class="numero-letras">{{ numeroEnLetras }}</p>
                  </div>
                </ion-card-content>
              </ion-card>
            </ion-card-content>
          </ion-card>
        </div>
        
        <!-- Tabla de Multiplicar -->
        <div v-else-if="currentView === 'Tabla'" class="page-container">
          <ion-card>
            <ion-card-header>
              <ion-card-title>Tabla de Multiplicar</ion-card-title>
              <ion-card-subtitle>Multiplicación hasta el 13</ion-card-subtitle>
            </ion-card-header>
            <ion-card-content>
              <ion-item>
                <ion-input 
                  v-model.number="numeroTabla" 
                  type="number" 
                  placeholder="Ingresa el número para la tabla"
                  label="Número"
                  label-placement="floating"
                  clear-input
                  min="1"
                  max="13"
                  
                ></ion-input>
              </ion-item>
              
              <ion-button 
                @click="generarTabla" 
                expand="block" 
                class="ion-margin-top"
                :disabled="!numeroTabla || numeroTabla < 1 || numeroTabla > 13"
              >
                <ion-icon :icon="calculatorOutline" slot="start"></ion-icon>
                Generar Tabla
              </ion-button>
              
              <div v-if="tabla.length > 0" class="tabla-container">
                <h3>Tabla del {{ numeroTabla }}</h3>
                <ion-list>
                  <ion-item v-for="(item, index) in tabla" :key="index" class="tabla-item">
                    <ion-label>
                      <h2>{{ item }}</h2>
                    </ion-label>
                  </ion-item>
                </ion-list>
              </div>
            </ion-card-content>
          </ion-card>
        </div>

        <!-- Experiencia - Video de YouTube -->
        <div v-else-if="currentView === 'Experiencia'" class="page-container">
          <ion-card>
            <ion-card-header>
              <ion-card-title>Mi Experiencia</ion-card-title>
              <ion-card-subtitle>Video demostrativo</ion-card-subtitle>
            </ion-card-header>
            <ion-card-content>
              <div class="video-container">
                <youtube-lite video="_ipwprOXg-Q" width="100%" height="auto"></youtube-lite>
              </div>
              
              
            </ion-card-content>
          </ion-card>
        </div>

        <!-- Vista por defecto -->
        <div v-else class="page-container">
          <ion-card>
            <ion-card-content>
              <h2>Página no encontrada</h2>
              <p>La página "{{ $route.params.id }}", error 404.</p>
            </ion-card-content>
          </ion-card>
        </div>

      </div>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import { 
  IonButtons, 
  IonContent, 
  IonHeader, 
  IonMenuButton, 
  IonPage, 
  IonTitle, 
  IonToolbar,
  IonCard,
  IonCardContent,
  IonCardHeader,
  IonCardTitle,
  IonCardSubtitle,
  IonItem,
  IonInput,
  IonButton,
  IonLabel,
  IonList,
  IonIcon,
  IonImg
} from '@ionic/vue';
import { ref, computed, onMounted } from 'vue';
import {
  mailOutline,
  addOutline,
  languageOutline,
  calculatorOutline,
} from 'ionicons/icons';
import { useRoute } from 'vue-router';

const route = useRoute();

// Variables reactivas
const num1 = ref<number | null>(null);
const num2 = ref<number | null>(null);
const resultadoSuma = ref<number | null>(null);
const numeroTraducir = ref<number | null>(null);
const numeroEnLetras = ref<string>('');
const numeroTabla = ref<number | null>(null);
const tabla = ref<string[]>([]);

// Vista actual basada en la ruta
const currentView = computed(() => {
  return route.params.id as string;
});

// Función para sumar
const sumar = () => {
  if (num1.value !== null && num2.value !== null) {
    resultadoSuma.value = num1.value + num2.value;
  }
};

// Función para traducir números a letras
const traducirNumero = () => {
  if (!numeroTraducir.value || numeroTraducir.value < 1 || numeroTraducir.value > 1000) {
    return;
  }
  numeroEnLetras.value = numeroALetras(numeroTraducir.value);
};

// Función para convertir número a letras
const numeroALetras = (num: number): string => {
  const unidades = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
  const especiales = ['diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
  const decenas = ['', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
  const centenas = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

  if (num === 1000) return 'mil';
  if (num === 100) return 'cien';
  
  let resultado = '';
  
  // Centenas
  if (num >= 100) {
    const c = Math.floor(num / 100);
    resultado += centenas[c];
    num %= 100;
    if (num > 0) resultado += ' ';
  }
  
  // Decenas y unidades
  if (num >= 20) {
    const d = Math.floor(num / 10);
    resultado += decenas[d];
    num %= 10;
    if (num > 0) {
      if (d === 2) {
        // Casos especiales del 21 al 29
        const veintis = ['', 'veintiuno', 'veintidós', 'veintitrés', 'veinticuatro', 'veinticinco', 'veintiséis', 'veintisiete', 'veintiocho', 'veintinueve'];
        resultado = resultado.replace('veinte', veintis[num]);
        num = 0;
      } else {
        resultado += ' y ' + unidades[num];
      }
    }
  } else if (num >= 10) {
    resultado += especiales[num - 10];
  } else if (num > 0) {
    resultado += unidades[num];
  }
  
  return resultado.trim();
};

// Función para generar tabla de multiplicar
const generarTabla = () => {
  if (!numeroTabla.value || numeroTabla.value < 0 || numeroTabla.value > 13) {
    return;
  }
  if (!numeroTabla.value) return;
  
  tabla.value = [];
  for (let i = 1; i <= 13; i++) {
    const resultado = numeroTabla.value * i;
    tabla.value.push(`${numeroTabla.value} × ${i} = ${resultado}`);
  }
};
</script>

<style scoped>
#container {
  padding: 20px;
  min-height: 100vh;
}

.page-container {
  max-width: 600px;
  margin: 0 auto;
}

.personal-info {
  text-align: center;
  padding: 30px 20px;
}

.photo-container {
  margin-bottom: 20px;
}

.profile-photo {
  width: 120px;
  height: 120px;
  border-radius: 10px;
  margin: 0 auto;
  object-fit: cover;
  border: 3px solid var(--ion-color-primary);
}

.name {
  font-size: 24px;
  font-weight: bold;
  color: var(--ion-color-primary);
  margin: 10px 0;
}

.email {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  font-size: 16px;
  color: var(--ion-color-medium);
  margin: 15px 0;
}

.welcome-text {
  font-size: 18px;
  font-weight: 500;
  color: var(--ion-color-dark);
  margin: 20px 0 10px 0;
}

.description {
  font-size: 14px;
  color: var(--ion-color-medium);
  line-height: 1.5;
}

.result-card {
  margin-top: 20px;
  background: var(--ion-color-light);
}

.result-display {
  text-align: center;
  padding: 20px;
}

.result-display h2, .result-display h3 {
  color: var(--ion-color-primary);
  margin: 0 0 10px 0;
}

.numero-letras {
  font-size: 18px;
  font-style: italic;
  color: var(--ion-color-dark);
  text-transform: capitalize;
}

.tabla-container {
  margin-top: 20px;
  text-align: center;
}

.tabla-container h3 {
  color: var(--ion-color-primary);
  margin-bottom: 15px;
}

.tabla-item {
  --background: var(--ion-color-light);
  margin: 5px 0;
  border-radius: 8px;
}

.video-container {
  margin-bottom: 20px;
  border-radius: 10px;
  overflow: hidden;
}

.video-description {
  text-align: left;
}

.video-description h3 {
  color: var(--ion-color-primary);
  margin-bottom: 10px;
}

.video-description p {
  color: var(--ion-color-dark);
  line-height: 1.5;
  margin-bottom: 20px;
}

@media (max-width: 768px) {
  #container {
    padding: 10px;
  }
  
  .profile-photo {
    width: 100px;
    height: 100px;
  }
  
  .name {
    font-size: 20px;
  }
  
  .video-container iframe {
    height: 200px;
  }
}
</style>