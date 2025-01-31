<script setup lang="ts">
import { watch, ref, computed, onMounted } from "vue";
import cronstrue from "cronstrue";
import { useHelpers } from "@/utils/composables/useHelpers";
import {
    NButton,
    NDatePicker,
    NFormItem,
    NInput,
    NInputNumber,
    NRadioButton,
    NRadioGroup,
    NSelect,
    NTimePicker,
    useMessage,
} from "naive-ui";
import Copy from "@/Components/App/Copy.vue";

interface Props {
    label: string;
}

const { label = "Choose Frequency:" } = defineProps<Props>();

const message = useMessage();
const daysOfWeek = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
];
const model = ref({
    frequency: "daily",
    time: null,
    date: null,
    dayOfWeek: null,
    dayOfMonth: null,
    customCron: "",
    cronDescription: "",
});

const cronExpression = defineModel("cronExpression", { default: "" });
const cronDescription = defineModel("cronDescription", { default: "" });
const cronDescriptionComputed = computed(() => {
    try {
        cronDescription.value = cronstrue.toString(cronExpression.value);
        return cronDescription.value;
    } catch (e) {
        cronDescription.value = "Invalid cron expression";
        return cronDescription.value;
    }
});

function validateCron() {
    try {
        model.value.cronDescription = cronstrue.toString(
            model.value.customCron,
        );
    } catch (e) {
        model.value.cronDescription = "";
    }
}

function processCron() {
    //prepare data
    const time = new Date(model.value.time);
    const options = {
        hour: "numeric",
        minute: "numeric",
        hour12: false,
    };
    let formated_time = time.toLocaleTimeString([], options);

    switch (model.value.frequency) {
        case "hourly":
            cronExpression.value = "0 * * * *";
            break;
        case "daily":
            const dailyTime = model.value.time
                ? formated_time.split(":")
                : ["0", "0"];
            cronExpression.value = `${dailyTime[1]} ${dailyTime[0]} * * *`;
            break;
        case "weekly":
            const weeklyTime = model.value.time
                ? formated_time.split(":")
                : ["0", "0"];
            cronExpression.value = `${weeklyTime[1]} ${weeklyTime[0]} * * ${model.value.dayOfWeek}`;
            break;
        case "monthly":
            const monthlyTime = model.value.time
                ? formated_time.split(":")
                : ["0", "0"];
            cronExpression.value = `${monthlyTime[1]} ${monthlyTime[0]} ${model.value.dayOfMonth} * *`;
            break;
        case "yearly":
            let formated_date = useHelpers()
                .dayjs(model.value.date)
                .format("YYYY-MM-DD");
            const [yearlyYear, yearlyMonth, yearlyDay] =
                formated_date.split("-");
            const yearlyTime = model.value.time
                ? formated_time.split(":")
                : ["0", "0"];
            cronExpression.value = `${yearlyTime[1]} ${yearlyTime[0]} ${yearlyDay} ${yearlyMonth} *`;
            break;
        case "custom":
            cronExpression.value = model.value.customCron;
            break;
    }

    if (model.value.frequency === "custom" && !model.value.cronDescription) {
        message.error("Please enter a valid cron expression");
        return;
    }
}

watch(
    model,
    () => {
        processCron();
    },
    { deep: true },
);
</script>

<template>
    <div class="border-l-2 pl-2">
        <n-form-item :label="label">
            <n-radio-group v-model:value="model.frequency">
                <n-radio-button label="Hourly" value="hourly" size="medium" />
                <n-radio-button label="Daily" value="daily" size="medium" />
                <n-radio-button label="Weekly" value="weekly" size="medium" />
                <n-radio-button label="Monthly" value="monthly" size="medium" />
                <!--<n-radio-button label="Yearly" value="yearly" size="medium" />-->
            </n-radio-group>
        </n-form-item>

        <div
            class="grid grid-cols-2 gap-x-5 mt-2"
            v-if="model.frequency === 'daily'"
        >
            <n-form-item label="Set Time">
                <n-time-picker
                    class="w-full"
                    format="h:mm"
                    v-model:value="model.time"
                />
            </n-form-item>
        </div>

        <div
            class="grid grid-cols-2 gap-x-5 mt-4"
            v-else-if="model.frequency === 'weekly'"
        >
            <n-form-item label="Select Day">
                <n-select
                    :options="
                        daysOfWeek.map((day, index) => {
                            return { label: day, value: index };
                        })
                    "
                    v-model:value="model.dayOfWeek"
                />
            </n-form-item>
            <n-form-item label="Set Time">
                <n-time-picker
                    class="w-full"
                    format="h:mm"
                    v-model:value="model.time"
                />
            </n-form-item>
        </div>
        <div
            class="grid grid-cols-2 gap-x-5 mt-4"
            v-if="model.frequency === 'monthly'"
        >
            <n-form-item label="Set Day of Month">
                <n-input-number
                    :min="1"
                    :max="31"
                    v-model:value="model.dayOfMonth"
                />
            </n-form-item>
            <n-form-item label="Set Time">
                <n-time-picker
                    class="w-full"
                    format="h:mm"
                    v-model:value="model.time"
                />
            </n-form-item>
        </div>
        <div
            class="grid grid-cols-2 gap-x-5 mt-4"
            v-if="model.frequency === 'yearly'"
        >
            <n-form-item label="Select Date">
                <n-date-picker
                    class="w-full"
                    format="Y-M-d"
                    v-model:value="model.date"
                />
            </n-form-item>
            <n-form-item label="Set Time">
                <n-time-picker
                    class="w-full"
                    format="h:mm"
                    v-model:value="model.time"
                />
            </n-form-item>
        </div>

        <div class="mt-4" v-if="model.frequency === 'custom'">
            <n-form-item
                label="Custom Cron Expression (Advanced):"
                :validation-status="
                    !model.cronDescription || !model.cronDescription.length
                        ? 'error'
                        : null
                "
            >
                <n-input
                    v-model:value="model.customCron"
                    placeholder="* * * * *"
                    :on-update-value="validateCron"
                />
            </n-form-item>
        </div>
        <div id="results">
            {{ cronDescriptionComputed }}

            <n-input
                v-if="cronExpression || cronExpression.length"
                disabled
                :value="cronExpression"
            >
                <template #suffix>
                    <Copy :content="cronExpression" />
                </template>
            </n-input>
        </div>
    </div>
</template>

<style scoped></style>
