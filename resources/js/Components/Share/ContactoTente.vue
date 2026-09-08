<template>
    <section class="sectionContacto">
        <div class="boxForm">
            <div class="bgContacto"></div>
            <div class="container">
                <div class="layoutContainer">
                    <div class="formContainer">
                        <div class="etiquetaContainer">
                            <span>Centro de Atención</span>
                        </div>
                        <div class="titularContainer">
                            <h2>
                               Encuentre la solución <br />TENTE ideal para su <br />operación
                            </h2>
                        </div>
                        <div class="descriptionContainer">
                            <p>
                                Complete el formulario y cuéntenos qué necesita mover. Uno de nuestros especialistas analizará sus requerimientos para recomendarle la solución TENTE más adecuada, brindarle asesoría técnica y preparar una cotización personalizada.
                            </p>
                        </div>
                        <form
                            class="formContacto"
                            novalidate
                            @submit="onSubmit"
                        >
                            <!-- Trampa para bots. No es un campo real: si viene lleno, se rechaza. -->
                            <div class="honeypot" aria-hidden="true">
                                <label for="website">No completar</label>
                                <input
                                    id="website"
                                    v-model="website"
                                    type="text"
                                    tabindex="-1"
                                    autocomplete="off"
                                />
                            </div>
                            <div class="formGrid">
                                <!-- Nombres -->
                                <div class="field">
                                    <label for="nombres"
                                        >Nombres o Razón Social</label
                                    >
                                    <input
                                        id="nombres"
                                        v-model="nombres"
                                        v-bind="nombresAttrs"
                                        type="text"
                                        placeholder="Juan Pérez"
                                        autocomplete="name"
                                        :class="{
                                            'is-invalid': errors.nombres,
                                        }"
                                        :aria-invalid="!!errors.nombres"
                                        :aria-describedby="
                                            errors.nombres
                                                ? 'err-nombres'
                                                : null
                                        "
                                    />
                                    <span
                                        v-if="errors.nombres"
                                        id="err-nombres"
                                        class="fieldError"
                                    >
                                        {{ errors.nombres }}
                                    </span>
                                </div>

                                <!-- Correo -->
                                <div class="field">
                                    <label for="email"
                                        >Correo electrónico</label
                                    >
                                    <input
                                        id="email"
                                        v-model="email"
                                        v-bind="emailAttrs"
                                        type="email"
                                        inputmode="email"
                                        placeholder="JuanPerez@gmail.com"
                                        autocomplete="email"
                                        :class="{ 'is-invalid': errors.email }"
                                        :aria-invalid="!!errors.email"
                                        :aria-describedby="
                                            errors.email ? 'err-email' : null
                                        "
                                    />
                                    <span
                                        v-if="errors.email"
                                        id="err-email"
                                        class="fieldError"
                                    >
                                        {{ errors.email }}
                                    </span>
                                </div>

                                <!-- Celular -->
                                <div class="field">
                                    <label for="celular"
                                        >Número de celular</label
                                    >
                                    <input
                                        id="celular"
                                        v-model="celular"
                                        v-bind="celularAttrs"
                                        type="tel"
                                        inputmode="tel"
                                        placeholder="+51 987 541 554"
                                        autocomplete="tel"
                                        :class="{
                                            'is-invalid': errors.celular,
                                        }"
                                        :aria-invalid="!!errors.celular"
                                        :aria-describedby="
                                            errors.celular
                                                ? 'err-celular'
                                                : null
                                        "
                                    />
                                    <span
                                        v-if="errors.celular"
                                        id="err-celular"
                                        class="fieldError"
                                    >
                                        {{ errors.celular }}
                                    </span>
                                </div>

                                <!-- Empresa -->
                                <div class="field">
                                    <label for="empresa">Empresa</label>
                                    <input
                                        id="empresa"
                                        v-model="empresa"
                                        v-bind="empresaAttrs"
                                        type="text"
                                        placeholder="Execor"
                                        autocomplete="organization"
                                        :class="{
                                            'is-invalid': errors.empresa,
                                        }"
                                        :aria-invalid="!!errors.empresa"
                                        :aria-describedby="
                                            errors.empresa
                                                ? 'err-empresa'
                                                : null
                                        "
                                    />
                                    <span
                                        v-if="errors.empresa"
                                        id="err-empresa"
                                        class="fieldError"
                                    >
                                        {{ errors.empresa }}
                                    </span>
                                </div>

                                <!-- Textarea -->
                                <div class="field field--full">
                                    <label for="proyecto"
                                        >¿Qué necesita mover? </label
                                    >
                                    <textarea
                                        id="proyecto"
                                        v-model="proyecto"
                                        v-bind="proyectoAttrs"
                                        rows="6"
                                        maxlength="1000"
                                        placeholder="Cuéntanos qué necesitas: alcance, plazos, ubicación..."
                                        :class="{
                                            'is-invalid': errors.proyecto,
                                        }"
                                        :aria-invalid="!!errors.proyecto"
                                        :aria-describedby="
                                            errors.proyecto
                                                ? 'err-proyecto'
                                                : null
                                        "
                                    ></textarea>
                                    <div class="fieldFoot">
                                        <span
                                            v-if="errors.proyecto"
                                            id="err-proyecto"
                                            class="fieldError"
                                        >
                                            {{ errors.proyecto }}
                                        </span>
                                        <span class="counter"
                                            >{{
                                                (proyecto || "").length
                                            }}/1000</span
                                        >
                                    </div>
                                </div>

                                <!-- Checkbox -->
                                <div class="field field--full">
                                    <label
                                        class="checkbox"
                                        :class="{
                                            'is-invalid': errors.privacidad,
                                        }"
                                    >
                                        <input
                                            id="privacidad"
                                            v-model="privacidad"
                                            v-bind="privacidadAttrs"
                                            type="checkbox"
                                            :true-value="true"
                                            :false-value="false"
                                        />
                                        <span>
                                            Acepto
                                            <Link
                                                href="/politica-de-privacidad"
                                                target="_blank"
                                            >
                                                política de privacidad
                                            </Link>
                                            de STEEL INGENIERÍA
                                        </span>
                                    </label>
                                    <span
                                        v-if="errors.privacidad"
                                        class="fieldError"
                                    >
                                        {{ errors.privacidad }}
                                    </span>
                                </div>
                            </div>

                            <div class="formActions">
                                <button
                                    type="submit"
                                    class="btnEnviar"
                                    :disabled="isSubmitting"
                                >
                                    {{
                                        isSubmitting
                                            ? "ENVIANDO..."
                                            : "ENVIAR INFORMACIÓN"
                                    }}
                                </button>

                                <p
                                    v-if="flashSuccess"
                                    class="formMsg formMsg--ok"
                                    role="status"
                                >
                                    {{ flashSuccess }}
                                </p>
                                <p
                                    v-if="errorGeneral"
                                    class="formMsg formMsg--error"
                                    role="alert"
                                >
                                    {{ errorGeneral }}
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { computed, ref } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
// ALIAS OBLIGATORIO: Inertia también exporta useForm. Sin alias, uno pisa al otro.
import { useForm as useVeeForm } from "vee-validate";
import { contactoSchema2 } from "./contactoSchema2";

const page = usePage();
const errorGeneral = ref(null);
const website = ref("");

// Mensaje de éxito desde el flash de Laravel: return back()->with('success', '...')
const flashSuccess = computed(() => page.props.flash?.success ?? null);

const {
    defineField,
    handleSubmit,
    errors,
    isSubmitting,
    resetForm,
    setErrors,
} = useVeeForm({
    validationSchema: contactoSchema2,
    // Sin initialValues, Zod reporta "Required" en vez de tus mensajes.
    initialValues: {
        nombres: "",
        email: "",
        celular: "",
        empresa: "",
        proyecto: "",
        privacidad: false,
    },
});

// validateOnModelUpdate: false -> valida en blur y en submit, no en cada tecla.
const cfg = { validateOnModelUpdate: false };

const [nombres, nombresAttrs] = defineField("nombres", cfg);
const [email, emailAttrs] = defineField("email", cfg);
const [celular, celularAttrs] = defineField("celular", cfg);
const [empresa, empresaAttrs] = defineField("empresa", cfg);
const [proyecto, proyectoAttrs] = defineField("proyecto", cfg);
// El checkbox valida al cambiar: el cambio ya es una acción deliberada.
const [privacidad, privacidadAttrs] = defineField("privacidad");

const onSubmit = handleSubmit(
    (values) => {
        errorGeneral.value = null;
        
        /*
         * router.post NO devuelve una promesa. Si haces el post "a secas",
         * handleSubmit resuelve de inmediato, isSubmitting vuelve a false
         * y el botón se reactiva antes de que el servidor responda.
         * Envolverlo y resolver en onFinish mantiene el estado correcto.
         */
        return new Promise((resolve) => {
            router.post(
                "/contacto/tente",
                { ...values, website: website.value },
                {
                    preserveScroll: true,
                    // Solo refresca las props que necesitas (flash), no toda la página
                    only: ["flash", "errors"],
                    onSuccess: () => {
                        resetForm();
                    },
                    onError: (backendErrors) => {
                        // Las keys de Laravel coinciden con los nombres de campo,
                        // así que se pintan directo en el input correspondiente.
                        setErrors(backendErrors);
                        const first = Object.keys(backendErrors)[0];
                        document.getElementById(first)?.focus();
                    },
                    onFinish: () => resolve(),
                },
            );
        });
    },
    // Falla la validación de cliente: foco al primer campo inválido.
    ({ errors: errs }) => {
        const first = Object.keys(errs)[0];
        document.getElementById(first)?.focus();
    },
);
</script>
<style lang="scss" scoped>
.honeypot {
    position: absolute;
    left: -9999px;
    width: 1px;
    height: 1px;
    overflow: hidden;
}
.sectionContacto {
    background-image: url("/images/bgatencion.png");
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    padding-bottom: 4rem;
    padding-top: 0rem;
    @media screen and (min-width: 992px) {
        padding-bottom: 8rem;
        padding-top: 8rem;
    }
    .boxForm {
        position: relative;
    }
    .container {
        position: relative;
        z-index: 5;
    }
    .layoutContainer {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1rem;
        .formContainer {
            grid-column: 1 / -1;
            margin-top: 3rem;
            @media screen and (min-width: 992px) {
                grid-column: 7/ -1;
                margin-top: 0rem;
            }
            .descriptionContainer {
                p {
                    font-size: 1rem;
                    line-height: 1.35em;
                    color: $color-text-light;
                    font-family: $font-sans;
                    font-weight: 400;
                    @media screen and (min-width: 992px) {
                        font-size: 1rem;
                        line-height: 1.35em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.125rem;
                        line-height: 1.5em;
                    }
                    span {
                        color: $color-primary-light;
                    }
                }
            }
            .etiquetaContainer {
                border: 1px solid $color-primary-light;
                border-radius: 30px;
                min-width: 171px;
                height: 34px;
                display: inline-block;
                text-align: center;
                span {
                    font-size: 0.9rem;
                    line-height: 2.35em;
                    color: $color-primary-light;
                    font-family: $font-red;
                    font-weight: 600;
                    @media screen and (min-width: 992px) {
                        font-size: 0.9rem;
                        line-height: 2.35em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1rem;
                        line-height: 2em;
                    }
                }
            }

            .titularContainer {
                margin: 1rem 0;
                h2 {
                    line-height: 1.15em;
                    font-size: 2rem;
                    color: $color-text-light;
                    font-family: $font-archia;
                    font-weight: 500;

                    @media screen and (min-width: 992px) {
                        line-height: 1.15em;
                        font-size: 2rem;
                    }
                    @media screen and (min-width: 1200px) {
                        line-height: 1em;
                        font-size: 2.625rem;
                        letter-spacing: -0.03em;
                    }
                    @media screen and (min-width: 1400px) {
                        letter-spacing: 0;
                    }
                }
            }
            .formContacto {
                --fc-border: #e6b9bf;
                --fc-border-focus: #c98f97;
                --fc-error: #c62828;
                --fc-accent: #f5b301;
                --fc-text: #6b5a5c;
                margin-top: 3rem;
            }

            .formGrid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.25rem 1.5rem;
                @media screen and (min-width: 768px) {
                    grid-template-columns: 1fr 1fr;
                }
            }
            .field {
                display: flex;
                flex-direction: column;
                min-width: 0;

                &--full {
                    @media screen and (min-width: 768px) {
                        grid-column: 1 / -1;
                    }
                }

                label {
                    font-size: 0.9rem;
                    color: var(--fc-text);
                    margin-bottom: 0.5rem;
                }

                input,
                select,
                textarea {
                    width: 100%;
                    padding: 0.85rem 1rem;
                    border: 1px solid #d9d9d9;
                    border-radius: 10px;
                    background: transparent;
                    font: inherit;
                    font-size: 0.95rem;
                    color: #3b2f31;
                    transition:
                        border-color 0.2s ease,
                        box-shadow 0.2s ease;

                    &::placeholder {
                        color: #c3a9ac;
                    }
                    &:focus {
                        outline: none;
                        border-color: var(--fc-border-focus);
                        box-shadow: 0 0 0 3px rgba(201, 143, 151, 0.18);
                    }
                    &.is-invalid {
                        border-color: var(--fc-error);
                        &:focus {
                            box-shadow: 0 0 0 3px rgba(198, 40, 40, 0.15);
                        }
                    }
                }

                select.is-placeholder {
                    color: #c3a9ac;
                }
                textarea {
                    resize: vertical;
                    min-height: 140px;
                }
            }

            .fieldFoot {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                gap: 1rem;
                margin-top: 0.35rem;
            }
            .counter {
                margin-left: auto;
                font-size: 0.75rem;
                color: #b09598;
                flex-shrink: 0;
            }

            .fieldError {
                margin-top: 0.35rem;
                font-size: 0.8rem;
                line-height: 1.3;
                color: var(--fc-error);
            }
            .fieldFoot .fieldError {
                margin-top: 0;
            }

            .checkbox {
                display: flex;
                align-items: flex-start;
                gap: 0.6rem;
                cursor: pointer;
                font-size: 0.875rem;
                color: var(--fc-text);
                margin-bottom: 0;

                input {
                    width: 18px;
                    height: 18px;
                    flex-shrink: 0;
                    margin-top: 1px;
                    accent-color: var(--fc-accent);
                    cursor: pointer;
                }
                a {
                    color: inherit;
                    text-decoration: underline;
                }
                &.is-invalid input {
                    outline: 2px solid var(--fc-error);
                    outline-offset: 2px;
                    border-radius: 3px;
                }
            }

            .formActions {
                margin-top: 2rem;
            }
            .btnEnviar {
                border: none;
                cursor: pointer;
                background: $color-secondary;
                color: $color-text2;
                font-family: $font-red;
                font-weight: 700;
                font-size: 0.85rem;
                letter-spacing: 0.04em;
                padding: 1.1rem 2.5rem;
                border-radius: 999px;
                width: 100%;
                transition:
                    transform 0.2s ease,
                    opacity 0.2s ease,
                    box-shadow 0.2s ease;

                @media screen and (min-width: 992px) {
                    width: auto;
                }

                &:hover:not(:disabled) {
                    transform: translateY(-2px);
                    box-shadow: 0 10px 24px -10px rgba(245, 179, 1, 0.8);
                }
                &:disabled {
                    opacity: 0.6;
                    cursor: not-allowed;
                }
            }

            .formMsg {
                margin: 1rem 0 0;
                font-size: 0.9rem;
                &--ok {
                    color: #1b7a3d;
                }
                &--error {
                    color: var(--fc-error);
                }
            }
        }
    }
    .bgContacto {
        width: 100%;
        height: 470px;
        background-image: url("/images/bgcontacto.png");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        @media screen and (min-width: 992px) {
            width: 45%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
    }
}
</style>
