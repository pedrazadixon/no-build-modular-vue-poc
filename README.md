# POC: Arquitectura Modular con Vue, Quasar y MobX desde CDN

## 🎯 Objetivo de la Prueba de Concepto

Esta POC demuestra una arquitectura frontend altamente escalable y sin proceso de compilación, que permite:

1. **Desarrollo sin Build**: Uso de Vue 3, Quasar y MobX completamente desde CDN, sin necesidad de Webpack, Vite o cualquier proceso de compilación.

2. **Estado Global Compartido**: Todos los módulos (implementados como iframes) acceden eficientemente a un estado global centralizado usando MobX.

3. **Arquitectura Modular Escalable**: Los iframes funcionan como módulos independientes con funcionalidades complejas que comparten estado a nivel de frontend.

4. **Iframes Anidados**: Soporte para iframes dentro de otros iframes, donde todos acceden al estado del padre absoluto (ventana principal).

## 🏗️ Arquitectura

### Estructura del Proyecto

```
poc-vue/
├── index.html              # Aplicación principal (padre absoluto)
├── index_iframe1.html      # Módulo 1 (iframe nivel 1)
├── index_iframe2.html      # Módulo 2 (iframe nivel 1)
├── index_iframe3.html      # Módulo 3 (iframe nivel 2, anidado en iframe2)
├── index_iframe4.html      # Módulo 4 (iframe nivel 3, anidado en iframe3)
└── js/
    ├── globalStore.js      # Store global con MobX
    └── storeAdapter.js     # Adaptador para compartir estado entre iframes
```

### Diagrama de Jerarquía

```
┌─────────────────────────────────────┐
│     index.html (Padre Absoluto)     │
│         globalStore: count = 0       │
├─────────────────┬───────────────────┤
│  iframe1.html   │   iframe2.html    │
│  (nivel 1)      │   (nivel 1)       │
│                 │   ┌───────────────┤
│                 │   │ iframe3.html  │
│                 │   │ (nivel 2)     │
│                 │   │ ┌─────────────┤
│                 │   │ │iframe4.html │
│                 │   │ │(nivel 3)    │
└─────────────────┴───┴─┴─────────────┘
        ↓         ↓     ↓       ↓
    Todos acceden al mismo globalStore
```

## 🔧 Tecnologías Utilizadas (desde CDN)

- **Vue 3.5.24**: Framework reactivo para la interfaz de usuario
- **Quasar 2.18.6**: Componentes UI de Material Design
- **MobX 6.15.0**: Gestión de estado reactivo

Todas las librerías se cargan directamente desde CDN sin necesidad de npm, node_modules o herramientas de build.

## 🚀 Características Principales

### 1. Sin Proceso de Compilación

Cada archivo HTML es completamente independiente y se ejecuta directamente en el navegador:

```html
<!-- Carga directa desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/vue@3.5.24/dist/vue.global.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quasar@2.18.6/dist/quasar.umd.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/mobx@6.15.0/dist/mobx.umd.production.min.js"></script>
```

**Ventajas:**
- ✅ Desarrollo rápido sin configuración
- ✅ No requiere Node.js ni npm
- ✅ Despliegue simple (solo archivos estáticos)
- ✅ Debugging directo en el navegador

### 2. Estado Global con MobX

El archivo `globalStore.js` define un store reactivo que se comparte entre todos los módulos:

```javascript
class GlobalStore {
  count = 0;

  constructor() {
    window.mobx.makeAutoObservable(this);
  }

  increment = () => {
    this.count++;
  };

  decrement = () => {
    this.count--;
  };
}

if (!window.globalStore) {
  window.globalStore = new GlobalStore();
}
```

**Características:**
- 🔄 Reactividad automática con `makeAutoObservable`
- 🌐 Disponible globalmente en `window.globalStore`
- 📦 Singleton garantizado con el condicional `if (!window.globalStore)`

### 3. Adaptador de Estado para Iframes

El archivo `storeAdapter.js` permite que los iframes accedan al store del padre:

```javascript
(function () {
  function getParentGlobal(key) {
    try {
      if (window.parent && window.parent !== window) {
        return window.parent[key];
      }
    } catch (e) {
      console.warn("No se pudo acceder al padre:", e);
      return null;
    }
    return null;
  }

  const parentMobx = getParentGlobal("mobx");
  const parentStore = getParentGlobal("globalStore");

  if (parentMobx) {
    window.mobx = parentMobx;
  }

  if (parentStore) {
    window.globalStore = parentStore;
  }
})();
```

**Funcionamiento:**
- 🔍 Detecta si el contexto actual es un iframe
- 🔗 Vincula `window.mobx` y `window.globalStore` del padre
- 🛡️ Manejo seguro de errores con try-catch
- 🎯 Los iframes anidados siempre apuntan al padre absoluto

### 4. Sincronización Reactiva en Vue

Cada módulo se suscribe a cambios del store usando `mobx.reaction`:

```javascript
const app = createApp({
  setup() {
    const counter = ref(window.parent.globalStore.count);

    window.parent.mobx.reaction(
      () => window.parent.globalStore.count,
      (newValue) => {
        counter.value = newValue;
      }
    );

    return {
      counter,
      increment: window.parent.globalStore.increment,
      decrement: window.parent.globalStore.decrement,
    };
  },
});
```

**Flujo de Datos:**
1. Se inicializa `counter` con el valor actual del store
2. `mobx.reaction` escucha cambios en `globalStore.count`
3. Cuando cambia, actualiza el `ref` de Vue automáticamente
4. Vue re-renderiza el componente con el nuevo valor

## 💡 Casos de Uso

Esta arquitectura es ideal para:

### 1. **Microfrontends sin Framework Complejo**
- Cada iframe puede ser un módulo completo (Dashboard, Settings, Reports)
- Sin necesidad de Module Federation o Single-SPA
- Despliegue independiente de cada módulo

### 2. **Aplicaciones Multi-tenant**
- Cada cliente puede tener módulos personalizados
- Estado compartido para datos del usuario
- Iframes pueden cargar desde diferentes dominios (con CORS configurado)

### 3. **Desarrollo Rápido de Prototipos**
- Sin configuración de build tools
- Cambios en vivo sin hot-reload
- Ideal para POCs y MVPs

### 4. **Legacy Integration**
- Integración de aplicaciones antiguas en iframes
- Estado moderno con MobX para nuevas features
- Migración gradual sin reescribir todo

## 🔄 Flujo de Comunicación

### Ejemplo: Incrementar el Contador

```
1. Usuario hace clic en "Increment" en iframe3.html
   ↓
2. Ejecuta: window.parent.globalStore.increment()
   ↓
3. MobX actualiza globalStore.count en la ventana principal
   ↓
4. mobx.reaction en TODOS los módulos detecta el cambio
   ↓
5. Cada módulo actualiza su ref de Vue
   ↓
6. Vue re-renderiza todos los componentes simultáneamente
```

**Resultado:** Todos los módulos (index.html, iframe1, iframe2, iframe3, iframe4) muestran el mismo valor actualizado en tiempo real.

## 🚀 Cómo Ejecutar

### Opción 1: Servidor Local Simple

```bash
# Con Python 3
python -m http.server 8000

# Con PHP (Laragon)
php -S localhost:8000

# Con Node.js (http-server)
npx http-server -p 8000
```

Luego abrir: `http://localhost:8000/index.html`

### Opción 2: Laragon (Windows)

1. Colocar la carpeta en `C:\laragon\www\poc-vue`
2. Acceder a: `http://localhost/poc-vue/index.html`

### Opción 3: VS Code Live Server

1. Instalar extensión "Live Server"
2. Click derecho en `index.html` → "Open with Live Server"

## 🎮 Funcionalidad Interactiva

Una vez abierta la aplicación:

1. **Observar el estado sincronizado**: Todos los módulos muestran el mismo contador
2. **Hacer clic en "Increment"** en cualquier módulo
3. **Ver la actualización instantánea** en todos los módulos simultáneamente
4. **Hacer clic en "Decrement"** en diferentes niveles de iframes
5. **Verificar que todos se sincronizan** sin importar la profundidad de anidamiento

## 📊 Ventajas de esta Arquitectura

### ✅ Desarrollo
- No requiere configuración de bundlers (Webpack, Rollup, Vite)
- Sin dependencias de npm
- Debugging directo en el navegador
- Cambios visibles con solo refrescar
- Ideal para equipos sin experiencia en tooling moderno

### ✅ Escalabilidad
- Cada iframe es un módulo independiente
- Se pueden cargar dinámicamente según necesidad
- Fácil agregar/remover módulos
- Lazy loading natural de módulos

### ✅ Mantenimiento
- Código simple y fácil de entender
- Sin archivos de configuración complejos
- Actualizaciones de librerías solo cambiando URL del CDN
- Cada módulo puede tener su propia versión de librerías si es necesario

### ✅ Despliegue
- Solo archivos estáticos (HTML/JS/CSS)
- Cualquier servidor web básico funciona
- CDN maneja caché de librerías
- Sin proceso de build en CI/CD

## ⚠️ Consideraciones

### Limitaciones

1. **Rendimiento**: Múltiples instancias de Vue/Quasar en memoria
   - *Solución*: Lazy loading de iframes, unload de módulos no usados

2. **SEO**: Los iframes no son rastreables por buscadores
   - *Solución*: Esta arquitectura es para aplicaciones internas, no sitios públicos

3. **Same-Origin Policy**: Los iframes deben estar en el mismo dominio
   - *Solución*: Usar postMessage para comunicación cross-origin si es necesario

4. **Tamaño de librerías**: Vue + Quasar + MobX suman ~500KB (comprimido)
   - *Ventaja*: CDN con caché agresivo mitiga el impacto

### Mejoras Potenciales

1. **TypeScript**: Agregar tipos para mejor DX
2. **Routing**: Implementar navegación entre módulos con Vue Router
3. **Autenticación**: Store global para estado de usuario/sesión
4. **Persistencia**: Sincronizar store con localStorage/sessionStorage
5. **WebSockets**: Sincronización multi-ventana con servidor

## 📝 Conclusión

Esta POC demuestra que es completamente viable construir aplicaciones modulares y escalables sin herramientas de build complejas. La combinación de:

- **Vue** (reactividad UI)
- **MobX** (gestión de estado)
- **Iframes** (aislamiento modular)
- **CDN** (distribución de librerías)

Resulta en una arquitectura simple, mantenible y altamente escalable, ideal para aplicaciones empresariales internas, dashboards modulares y prototipos rápidos.

## 📚 Referencias

- [Vue 3 Documentation](https://vuejs.org/)
- [Quasar Framework](https://quasar.dev/)
- [MobX Documentation](https://mobx.js.org/)
- [Window.postMessage() API](https://developer.mozilla.org/en-US/docs/Web/API/Window/postMessage)

---

**Versión:** 1.0  
**Última actualización:** Noviembre 2025  
**Autor:** Dixon Pedraza
