import React, { Component } from 'react';


class Stopwatch extends Component {
  state = {
    running: false, // By default it is in stop state.
    time: {
      hour: 0,
      min: 0,
      sec: 0,
      ms: 0
    }
  }

  _timerId = undefined

  style = {
    maxWidth: 320,
    minWidth: 300
  }

  msNumStyle = {
    'fontSize': 8,
    'fontFamily': 'monospace'
  }


  prettyTime = (val) => {
    let value = String(val);
    return (value.length === 1) ? "0" + value : value;
  };

  getStartButtonClasses = () => {
    return (this.state.running === false) ? "btn btn-outline-primary btn-sm px-4 m-2" : "btn btn-outline-secondary btn-sm px-4 m-2";
  };

  getButtonValue = () => {
    return (this.state.running === false) ? "Start" : "Stop";
  };

  async updateClock() {
    this._timerId = setInterval(() => { // Run this code after fixed interval.
      const stateModified = this.state;
      stateModified.time.ms += 100;
      if (stateModified.time.ms >= 1000) {
        stateModified.time.sec++;
        stateModified.time.ms = stateModified.time.ms % 1000;
      }
      if (stateModified.time.sec >= 60) {
        stateModified.time.min++;
        stateModified.time.sec = stateModified.time.sec % 60;
      }
      if (stateModified.time.min >= 60) {
        stateModified.time.hour++;
        stateModified.time.min = stateModified.time.min % 60;
      }

      this.setState(stateModified);
    }, 100); // interval | 1000ms = 1s
  }


  handleStart = () => {
    const oldModified = this.state;
    if (!oldModified.running) { // If stopwatch is not running.
      oldModified.running = true;
      this.setState(oldModified);
      this.updateClock();
      return;
    }
    oldModified.running = false;  // else...
    clearInterval(this._timerId);
    this.setState(oldModified);
  };
  handleReset = () => {
    const oldModified = this.state;
    oldModified.running = false;
    if (this._timerId) clearInterval(this._timerId); // if _timerID is truty.
    oldModified.time = { hour: 0, min: 0, sec: 0, ms: 0 };
    this.setState(oldModified);
  };

  closeBtnStyle = {
    'display': 'flex',
    'flexFlow': 'row-reverse',
    'paddingBottom': 4
  }

  render() {
    return (
      <React.Fragment>
        <div className="col-md-4 card m-2 p-0 bg-grey" style={this.style}>
          <div style={this.closeBtnStyle}>
            <button style={{ width: 24 }} type='button' onClick={this.props.onCloseClick} className='close' >&times;</button>
          </div>
          <div className="card-body bg-dark text-white">
            <div className="text-center">
              <span>
                <span className="display-4">{this.prettyTime(this.state.time.hour)}</span>
                <span className="display-4">:</span>
                <span className="display-4">{this.prettyTime(this.state.time.min)}</span>
                <span className="display-4">:</span>
                <span className="display-4">{this.prettyTime(this.state.time.sec)}</span>
                <span style={this.msNumStyle}>{this.prettyTime(this.state.time.ms).slice(0, 2)}</span>

              </span>
            </div>
          </div>
          <div className="card-footer bg-grey">
            <div className="float-right">
              <button type="button" onClick={this.handleStart} className={this.getStartButtonClasses()}>{this.getButtonValue()}</button>
              <button type="button" onClick={this.handleReset} className="btn btn-outline-danger btn-sm px-4 m-2">Reset</button>
            </div>
          </div>
        </div>

      </React.Fragment >
    );
  }
}

export default Stopwatch;
