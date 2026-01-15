/**
 * Helper para usar MobX stores con Vue de forma reactiva
 * Similar a useStore de nanostores pero para MobX + window.globalStore
 */

/**
 * Crea un ref reactivo de Vue que se sincroniza automáticamente con una propiedad MobX
 * @param {Function} selector - Función que retorna el valor del store (ej: () => window.globalStore.appStore.darkMode)
 * @param {*} initialValue - Valor inicial opcional (si no se provee, usa el resultado del selector)
 * @returns {Ref} - Ref de Vue sincronizado con MobX
 */
function useMobxRef(selector, initialValue) {
  const { ref } = Vue;
  const value = ref(initialValue !== undefined ? initialValue : selector());

  mobx.reaction(
    selector,
    (newValue) => {
      value.value = newValue;
    }
  );

  return value;
}

/**
 * Crea múltiples refs reactivos desde un objeto de selectores
 * @param {Object} selectors - Objeto con selectores { key: () => store.value }
 * @returns {Object} - Objeto con refs de Vue sincronizados
 * 
 * Ejemplo:
 * const { count, darkMode } = useMobxRefs({
 *   count: () => window.globalStore.counterStore.count,
 *   darkMode: () => window.globalStore.appStore.darkMode
 * });
 */
function useMobxRefs(selectors) {
  const { ref } = Vue;
  const refs = {};

  // Crear refs iniciales
  for (const key in selectors) {
    refs[key] = ref(selectors[key]());
  }

  // Crear una sola reaction para todos los valores
  mobx.reaction(
    () => {
      const values = {};
      for (const key in selectors) {
        values[key] = selectors[key]();
      }
      return values;
    },
    (newValues) => {
      for (const key in newValues) {
        refs[key].value = newValues[key];
      }
    }
  );

  return refs;
}

/**
 * Hook principal - Crea refs reactivos y extrae acciones de un store MobX
 * @param {Object} store - El store MobX (ej: window.globalStore.appStore)
 * @param {Array<string>} keys - Array de keys a extraer del store (propiedades + acciones)
 * @returns {Object} - Objeto con refs reactivos para propiedades y funciones para acciones
 * 
 * Ejemplo:
 * const { darkMode, leftDrawerOpen, toggleDarkMode, toggleLeftDrawer } = useMobxStore(
 *   window.globalStore.appStore,
 *   ['darkMode', 'leftDrawerOpen', 'toggleDarkMode', 'toggleLeftDrawer']
 * );
 */
function useMobxStore(store, keys) {
  const { ref } = Vue;
  const result = {};
  const observableKeys = [];

  // Separar propiedades observables de acciones
  for (const key of keys) {
    if (typeof store[key] === 'function') {
      // Es una acción - pasar directamente
      result[key] = store[key];
    } else {
      // Es una propiedad observable - crear ref
      result[key] = ref(store[key]);
      observableKeys.push(key);
    }
  }

  // Crear reaction solo para propiedades observables
  if (observableKeys.length > 0) {
    mobx.reaction(
      () => {
        const values = {};
        for (const key of observableKeys) {
          values[key] = store[key];
        }
        return values;
      },
      (newValues) => {
        for (const key in newValues) {
          result[key].value = newValues[key];
        }
      }
    );
  }

  return result;
}

/**
 * Versión simplificada que toma todo el store automáticamente
 * @param {Object} store - El store MobX
 * @returns {Object} - Todas las propiedades como refs y acciones como funciones
 * 
 * Ejemplo:
 * const appStore = useMobxStoreAuto(window.globalStore.appStore);
 * // appStore.darkMode es un ref reactivo
 * // appStore.toggleDarkMode es la función del store
 */
function useMobxStoreAuto(store) {
  const keys = Object.keys(store);
  return useMobxStore(store, keys);
}

/**
 * Computed reactivo desde MobX
 * @param {Function} getter - Función que computa un valor desde el store
 * @returns {ComputedRef} - Computed de Vue sincronizado
 * 
 * Ejemplo:
 * const doubleCount = useMobxComputed(() => window.globalStore.counterStore.count * 2);
 */
function useMobxComputed(getter) {
  const { ref, computed } = Vue;
  const value = ref(getter());

  mobx.reaction(
    getter,
    (newValue) => {
      value.value = newValue;
    }
  );

  return computed(() => value.value);
}

// Exponer globalmente
window.useMobxRef = useMobxRef;
window.useMobxRefs = useMobxRefs;
window.useMobxStore = useMobxStore;
window.useMobxStoreAuto = useMobxStoreAuto;
window.useMobxComputed = useMobxComputed;
