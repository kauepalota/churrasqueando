<div x-data="{
    datePickerOpen: false,
    datePickerValue: '',
    datePickerFormat: 'DD/MM/YYYY H:i',
    datePickerMonth: '',
    datePickerYear: '',
    datePickerDay: '',
    datePickerHours: '00',
    datePickerMinutes: '00',
    datePickerDaysInMonth: [],
    datePickerBlankDaysInMonth: [],
    datePickerMonthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    datePickerDays: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
    datePickerDayClicked(day) {
        let selectedDate = new Date(this.datePickerYear, this.datePickerMonth, day, this.datePickerHours, this.datePickerMinutes);
        this.datePickerDay = day;
        this.datePickerValue = this.datePickerFormatDate(selectedDate);
        this.datePickerIsSelectedDate(day);
    },
    datePickerPreviousMonth() {
        if (this.datePickerMonth == 0) {
            this.datePickerYear--;
            this.datePickerMonth = 11;
        } else {
            this.datePickerMonth--;
        }
        this.datePickerCalculateDays();
    },
    datePickerNextMonth() {
        if (this.datePickerMonth == 11) {
            this.datePickerMonth = 0;
            this.datePickerYear++;
        } else {
            this.datePickerMonth++;
        }
        this.datePickerCalculateDays();
    },
    datePickerIsSelectedDate(day) {
        const d = new Date(this.datePickerYear, this.datePickerMonth, day, this.datePickerHours, this.datePickerMinutes);
        return this.datePickerValue === this.datePickerFormatDate(d) ? true : false;
    },
    datePickerIsToday(day) {
        const today = new Date();
        const d = new Date(this.datePickerYear, this.datePickerMonth, day);
        return today.toDateString() === d.toDateString() ? true : false;
    },
    datePickerCalculateDays() {
        let daysInMonth = new Date(this.datePickerYear, this.datePickerMonth + 1, 0).getDate();
        // find where to start calendar day of week
        let dayOfWeek = new Date(this.datePickerYear, this.datePickerMonth).getDay();
        let blankdaysArray = [];
        for (var i = 1; i <= dayOfWeek; i++) {
            blankdaysArray.push(i);
        }
        let daysArray = [];
        for (var i = 1; i <= daysInMonth; i++) {
            daysArray.push(i);
        }
        this.datePickerBlankDaysInMonth = blankdaysArray;
        this.datePickerDaysInMonth = daysArray;
    },
    datePickerFormatDate(date) {
        let formattedDay = this.datePickerDays[date.getDay()];
        let formattedDate = ('0' + date.getDate()).slice(-2); // appends 0 (zero) in single digit date
        let formattedMonth = this.datePickerMonthNames[date.getMonth()];
        let formattedMonthShortName = this.datePickerMonthNames[date.getMonth()].substring(0, 3);
        let formattedMonthInNumber = ('0' + (parseInt(date.getMonth()) + 1)).slice(-2);
        let formattedYear = date.getFullYear();
        let formattedHours = ('0' + date.getHours()).slice(-2);
        let formattedMinutes = ('0' + date.getMinutes()).slice(-2);

        if (this.datePickerFormat === 'M d, Y H:i') {
            return `${formattedMonthShortName} ${formattedDate}, ${formattedYear} ${formattedHours}:${formattedMinutes}`;
        }
        if (this.datePickerFormat === 'MM-DD-YYYY H:i') {
            return `${formattedMonthInNumber}-${formattedDate}-${formattedYear} ${formattedHours}:${formattedMinutes}`;
        }
        if (this.datePickerFormat === 'DD/MM/YYYY H:i') {
            return `${formattedDate}/${formattedMonthInNumber}/${formattedYear} ${formattedHours}:${formattedMinutes}`;
        }
        if (this.datePickerFormat === 'YYYY-MM-DD H:i') {
            return `${formattedYear}-${formattedMonthInNumber}-${formattedDate} ${formattedHours}:${formattedMinutes}`;
        }
        if (this.datePickerFormat === 'D d M, Y H:i') {
            return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear} ${formattedHours}:${formattedMinutes}`;
        }

        return `${formattedMonth} ${formattedDate}, ${formattedYear} ${formattedHours}:${formattedMinutes}`;
    },
}" x-init="currentDate = new Date();
if (datePickerValue) {
    currentDate = new Date(Date.parse(datePickerValue));
}
datePickerMonth = currentDate.getMonth();
datePickerYear = currentDate.getFullYear();
datePickerDay = currentDate.getDay();
datePickerHours = ('0' + currentDate.getHours()).slice(-2);
datePickerMinutes = ('0' + currentDate.getMinutes()).slice(-2);
datePickerValue = datePickerFormatDate(currentDate);
datePickerCalculateDays();" x-cloak>
    <div class="container mx-auto mb-3">
        <div class="w-full mb-5">
            <div class="relative w-[17rem]">
                <input x-ref="datePickerInput" type="text" @click="datePickerOpen=!datePickerOpen;"
                    x-model="datePickerValue" x-on:keydown.escape="datePickerOpen=false" id="date" name="date"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight read-only:cursor-not-allowed read-only:opacity-50"
                    placeholder="Select date and time" />
                <div @click="datePickerOpen=!datePickerOpen; if(datePickerOpen){ $refs.datePickerInput.focus() }"
                    class="absolute top-0 right-0 px-3 py-2 cursor-pointer text-neutral-400 hover:text-neutral-500">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div x-show="datePickerOpen" x-transition @click.away="datePickerOpen = false"
                    class="absolute top-0 left-0 max-w-lg p-4 mt-12 antialiased bg-white border rounded-lg shadow w-[17rem] border-neutral-200/70 z-20">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <span x-text="datePickerMonthNames[datePickerMonth]"
                                class="text-lg font-bold text-gray-800"></span>
                            <span x-text="datePickerYear" class="ml-1 text-lg font-normal text-gray-600"></span>
                        </div>
                        <div>
                            <button @click="datePickerPreviousMonth()" type="button"
                                class="inline-flex p-1 transition duration-100 ease-in-out rounded-full cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-100">
                                <svg class="inline-flex w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button @click="datePickerNextMonth()" type="button"
                                class="inline-flex p-1 transition duration-100 ease-in-out rounded-full cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-100">
                                <svg class="inline-flex w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-7 mb-3">
                        <template x-for="(day, index) in datePickerDays" :key="index">
                            <div class="px-0.5">
                                <div x-text="day" class="text-xs font-medium text-center text-gray-800"></div>
                            </div>
                        </template>
                    </div>
                    <div class="grid grid-cols-7">
                        <template x-for="blankday in datePickerBlankDaysInMonth">
                            <div class="p-1 text-sm text-center border border-transparent"></div>
                        </template>
                        <template x-for="(date, dateIndex) in datePickerDaysInMonth" :key="dateIndex">
                            <div @click="datePickerDayClicked(date)" x-text="date"
                                class="p-1 text-sm leading-none text-center transition duration-100 ease-in-out border border-transparent rounded-full cursor-pointer select-none h-7 w-7 focus:outline-none focus:shadow-outline hover:bg-red-300"
                                :class="{
                                    'bg-neutral-200/70 text-gray-700 font-medium': datePickerIsToday(
                                        date),
                                    'bg-red-500 text-white font-semibold': datePickerIsSelectedDate(date)
                                }">
                            </div>
                        </template>
                    </div>
                    <div class="grid grid-cols-2 mt-4 gap-x-2">
                        <label for="hours" class="block text-sm font-medium text-neutral-500">Hora</label>
                        <label for="minutes" class="block text-sm font-medium text-neutral-500">Minuto</label>
                        <input type="number" x-model="datePickerHours" min="0" max="23"
                            class="w-full px-3 py-2 text-sm bg-white border rounded-md text-neutral-600 border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400" />
                        <input type="number" x-model="datePickerMinutes" min="0" max="59"
                            class="w-full px-3 py-2 text-sm bg-white border rounded-md text-neutral-600 border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
