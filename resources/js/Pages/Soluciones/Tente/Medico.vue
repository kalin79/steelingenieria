<template>
    <AppLayout>
        <Hero :slides="banners" />
        <TenteComponent />
        <DescripcionComponent :dataDescripcion="serviciosDescripcionData" />
        <LineasComponent :lineas="Lineas" />
        <!-- <GaleriaComponent :galerias="Galerias" /> -->
        <SeparateComponent />
        <ContactoComponent />
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Hero from "@/Components/Hero.vue";
import ContactoComponent from "@/Components/Share/Atencion.vue";
import DescripcionComponent from "@/Components/Tente/Descripcion.vue";
import TenteComponent from "@/Components/Share/Tente.vue";
import SeparateComponent from "@/Components/Share/Separate.vue";
import LineasComponent from "@/Components/Share/Tente/Lineas.vue";
// import GaleriaComponent from "@/Components/Share/MasterMover/Galeria.vue";
const banners = [
    {
        id: 1,
        image: "/images/bgm.png",
        imageM: "/images/bgm.png",
        title: "Movilidad <br />especializada para <br />equipos médicos",
        subtitle: "Sector Médico",
        description: `Ruedas TENTE para equipos médicos y hospitalarios, con rodadura <br />silenciosa, alta resistencia y movilidad segura.`,
        boton: ``,
        link: ``,
    },
];

const serviciosDescripcionData = {
    imagen: `medi.png`,
    etiqueta: `Sector Médico`,
    title: `Ruedas para Camas Médicas y Camillas`,
    descripcion: `<p>Garantiza una movilidad segura y eficiente en entornos hospitalarios. Las ruedas y aros TENTE para camas médicas y camillas están diseñados para soportar el uso intensivo, ofreciendo desplazamiento suave, silencioso y preciso en diferentes superficies.</p><p>Sus materiales resistentes e higiénicos, junto con sistemas de dirección y frenado confiables, facilitan la maniobrabilidad del personal médico y permiten un mayor control durante el traslado de pacientes. Una solución orientada a hospitales, clínicas y fabricantes de equipamiento médico que buscan seguridad, durabilidad y alto desempeño.</p>`,
};

const Lineas = {
    subtitulo: ``,
    titulo: `Movimiento seguro, <br />operación eficiente`,
    descripcion: `Para hospitales, clínicas y equipamiento médico: movilidad segura, precisión y confiabilidad para una operación eficiente.`,
    productos: [
        {
            imagen: `/images/t24.png`,
            subtitulo: `SERIE INTEGRAL`,
            titulo: `Rueda giratoria 125 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `125 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `150 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
            ],
        },
        {
            imagen: `/images/t25.png`,
            subtitulo: `SERIE INTEGRAL`,
            titulo: `Rueda giratoria con central, Freno total 125 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `125 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `150 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t26.png`,
            subtitulo: `SERIE INTEGRAL TWIN`,
            titulo: `Rueda giratoria con central, Freno total 100 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `100 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `125 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t27.png`,
            subtitulo: `SERIE INTEGRAL TWIN`,
            titulo: `Rueda giratoria con central, Freno total 150 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `150 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `150 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t28.png`,
            subtitulo: `SERIE LUMINA`,
            titulo: `Rueda giratoria con Freno de rueda 50 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Polipropileno</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `50 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `80 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t29.png`,
            subtitulo: `SERIE LUMINA`,
            titulo: `Rueda giratoria  50 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Polipropileno</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `50 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `80 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t30.png`,
            subtitulo: `SERIE LUMINA`,
            titulo: `Rueda giratoria  50 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `100 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `125 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t31.png`,
            subtitulo: `LÍNEA LIGHT`,
            titulo: `Rueda giratoria con Freno de rueda 75 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `75 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `70 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t32.png`,
            subtitulo: `LÍNEA LIGHT`,
            titulo: `Rueda giratoria  65 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Polipropileno</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `65 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `50 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
            ],
        },
        {
            imagen: `/images/t32.png`,
            subtitulo: `SERIE LEVINA`,
            titulo: `Rueda giratoria con Freno total 150 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Polipropileno</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `150 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `100 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t33.png`,
            subtitulo: `SERIE LEVINA`,
            titulo: `Rueda giratoria Rueda 100 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `100 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `100 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
            ],
        },
        {
            imagen: `/images/t34.png`,
            subtitulo: `SERIE LEVINA`,
            titulo: `Rueda giratoria Rueda 100 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `100 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `100 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
            ],
        },
        {
            imagen: `/images/t35.png`,
            subtitulo: `SERIE LEVINA`,
            titulo: `Rueda giratoria con Freno total 150 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `150 mm`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `100 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
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
