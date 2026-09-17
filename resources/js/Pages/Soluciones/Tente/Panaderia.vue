<template>
    <AppLayout>
        <Hero :slides="banners" />
        <TenteComponent />
        <DescripcionComponent :dataDescripcion="serviciosDescripcionData" />
        <LineasComponent :lineas="Lineas" />
        <!-- <GaleriaComponent :galerias="Galerias" /> -->
        <!-- <SeparateComponent /> -->
        <ContactoComponent />
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Hero from "@/Components/Hero.vue";
import ContactoComponent from "@/Components/Share/ContactoTente.vue";
import DescripcionComponent from "@/Components/Tente/Descripcion.vue";
import TenteComponent from "@/Components/Share/Tente.vue";
import SeparateComponent from "@/Components/Share/Separate.vue";
import LineasComponent from "@/Components/Share/Tente/Lineas.vue";
// import GaleriaComponent from "@/Components/Share/MasterMover/Galeria.vue";
const banners = [
    {
        id: 1,
        image: "/images/bgpa.png",
        imageM: "/images/bgpa.png",
        title: "Soluciones de Movilidad <br />Alimentaria",
        subtitle: "Sector Panadería",
        description: `Movilidad eficiente para el procesamiento y manejo de alimentos.`,
        boton: ``,
        link: ``,
    },
];

const serviciosDescripcionData = {
    imagen: `panad.png`,
    etiqueta: `Sector Panadería`,
    title: `Ruedas para la Industria Alimentaria`,
    descripcion: `<p>Las ruedas TENTE están diseñadas para responder a las exigencias de movilidad de la industria alimentaria, facilitando el desplazamiento de carros, racks, equipos de transporte y sistemas móviles dentro de plantas de producción, procesamiento y distribución.</p><p>Su diseño permite una rodadura suave y silenciosa, reduciendo el esfuerzo necesario para mover cargas y mejorando la eficiencia de las operaciones. Además, ofrecen alta capacidad de carga, resistencia a la corrosión, facilidad de limpieza y opciones de frenado seguro.</p><p>Para aplicaciones cercanas a hornos y zonas de cocción, existen soluciones capaces de soportar altas temperaturas, proporcionando un desplazamiento confiable incluso en entornos expuestos al calor generado por procesos de horneado y cocción.</p>`,
};

const Lineas = {
    subtitulo: ``,
    titulo: `Movimiento seguro, <br />operación eficiente`,
    descripcion: `Para supermercados, almacenes y logística: movilidad, estabilidad y resistencia para una operación más eficiente.`,
    productos: [
        {
            imagen: `/images/t37.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Serie ALPHA - 3470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `100 - 350 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-40/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `108 -240 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `80 - 200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t38.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Serie ALPHA - 8470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `230 - 500 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-30/+180 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `161 -195 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `125 - 150 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t39.png`,
            subtitulo: `SERIE ALPHA STAINLESS`,
            titulo: `Serie ALPHA - 3470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `100 - 150 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-40/+280 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `108 -128 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `80 - 100 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t40.png`,
            subtitulo: `SERIE ALPHA STAINLESS`,
            titulo: `Serie ALPHA inox- 8470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `160 - 400 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `128 -240 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100 - 200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t41.png`,
            subtitulo: `SERIE DURATECH HEAT`,
            titulo: `Serie ALPHA - 3470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `200 - 250 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-40/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: ``,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `80 - 100 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
    ],
};

const Galerias = {
    subtitulo: ``,
    titulo: `Así trabaja nuestra gama <br />MasterTow`,
    descripcion: ``,
    fotos: [
        {
            imagen: `/images/foto6.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto9.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto8.png`,
            alt: ``,
            destacado: true,
        },
        {
            imagen: `/images/foto7.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto10.png`,
            alt: ``,
            destacado: false,
        },
    ],
};
</script>
