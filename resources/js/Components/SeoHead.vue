<template>
    <Head v-if="tieneSeo" :title="seo.title">
        <meta
            v-if="seo.description"
            head-key="description"
            name="description"
            :content="seo.description"
        />
        <meta
            v-if="seo.keywords"
            head-key="keywords"
            name="keywords"
            :content="seo.keywords"
        />
        <link head-key="canonical" rel="canonical" :href="seo.canonical" />
        <meta head-key="robots" name="robots" :content="seo.robots" />

        <meta head-key="og:type" property="og:type" :content="seo.type" />
        <meta
            head-key="og:site_name"
            property="og:site_name"
            :content="seo.siteName"
        />
        <meta head-key="og:title" property="og:title" :content="seo.title" />
        <meta head-key="og:url" property="og:url" :content="seo.canonical" />
        <meta head-key="og:locale" property="og:locale" :content="seo.locale" />
        <meta
            v-if="seo.description"
            head-key="og:description"
            property="og:description"
            :content="seo.description"
        />
        <meta
            v-if="seo.image"
            head-key="og:image"
            property="og:image"
            :content="seo.image"
        />
        <meta
            v-if="seo.image"
            head-key="og:image:width"
            property="og:image:width"
            content="1200"
        />
        <meta
            v-if="seo.image"
            head-key="og:image:height"
            property="og:image:height"
            content="630"
        />

        <meta
            head-key="twitter:card"
            name="twitter:card"
            :content="seo.image ? 'summary_large_image' : 'summary'"
        />
        <meta
            head-key="twitter:title"
            name="twitter:title"
            :content="seo.title"
        />
        <meta
            v-if="seo.description"
            head-key="twitter:description"
            name="twitter:description"
            :content="seo.description"
        />
        <meta
            v-if="seo.image"
            head-key="twitter:image"
            name="twitter:image"
            :content="seo.image"
        />
    </Head>
</template>

<script setup>
import { computed } from "vue";
import { Head, usePage } from "@inertiajs/vue3";

/*
 * Mantiene el head sincronizado durante la navegacion del lado del cliente.
 *
 * El problema que resuelve: app.blade.php se renderiza UNA sola vez, en la
 * carga inicial. Las navegaciones de Inertia son peticiones XHR que solo
 * reemplazan el componente de pagina, asi que el <title> y los <meta> se
 * quedaban con los de la primera pagina visitada hasta recargar a mano.
 *
 * Cada etiqueta lleva head-key, que el adaptador de Vue traduce al
 * atributo data-inertia. Sin esa clave todas comparten data-inertia=""
 * y se pisan entre si: sobrevive una sola.
 *
 * Los datos se leen de usePage() y no de una prop para que alcance con
 * montarlo en AppLayout: ninguna pagina necesita pasar nada.
 */
const page = usePage();

const seo = computed(() => page.props.seo ?? {});

/*
 * Guarda: hay controladores que todavia no envian la prop seo (las
 * paginas de Tente y MasterMover). Sin este control, al navegar a una de
 * ellas se emitirian etiquetas con content vacio y quedaria un head peor
 * que el anterior. Mientras no manden seo, se conserva el head de la
 * pagina previa: es incorrecto, pero no rompe nada, y lo correcto es
 * agregarles su Seo::make() en el controlador.
 */
const tieneSeo = computed(() => Boolean(seo.value.title));
</script>
