let calendarSettings = {
    date: moment().set('date', 1),
    today: moment()
  }
  
  const incrementMonth = () => {
    calendarSettings.date.add(1, 'Months')
    console.log(`incremented to ${calendarSettings.date}`)
    displayCalendar(calendarSettings)
  }
  
  const decrementMonth = () => {
    calendarSettings.date.subtract(1, 'Months')
    console.log(`decremented to ${calendarSettings.date}`)
    displayCalendar(calendarSettings)
  }
  
  const displayCalendar = (calendarSettings) => {
  
    const calendar = document.querySelector('.calendar-grid')
    
    const calendarTitle = calendarSettings.date.format('MMMM YYYY')
    const daysInMonth = calendarSettings.date.endOf('Month').date()
    const firstDay = calendarSettings.date.startOf('Month').isoWeekday()
  
    calendar.innerHTML = ''
    calendar.innerHTML = `
                          <div class="calendar-nav"><a onClick="decrementMonth()">&lt; </a></div>
                          <div class="calendar-title">${calendarTitle}</div>
                          <div class="calendar-nav calendar-nav__right"><a onClick="incrementMonth()"> &gt;</a></div>
                          <div class="calendar-dayname">Mon</div>
                          <div class="calendar-dayname">Tue</div>
                          <div class="calendar-dayname">Wed</div>
                          <div class="calendar-dayname">Thur</div>
                          <div class="calendar-dayname">Fri</div>
                          <div class="calendar-dayname">Sat</div>
                          <div class="calendar-dayname">Sun</div>
                          `
    
    for (let day = 1; day <= daysInMonth; day++) {
      let calendarDay = document.createElement('div')
      if (day === 1) {
        calendarDay.setAttribute('style', `grid-column-start:${firstDay}`)
        console.log(`firstDay = ${firstDay}`)
      }
      calendarDay.classList.add('calendar-day')
      if (calendarSettings.today.month() == calendarSettings.date.month() && calendarSettings.today.year() == calendarSettings.date.year()) {
        if (calendarSettings.today.date() == day) {
          calendarDay.classList.add('current-day')
        }
      }
      calendarDay.innerHTML = day
      calendar.appendChild(calendarDay)
    }
  
  
  }
  
  displayCalendar(calendarSettings);
  
  