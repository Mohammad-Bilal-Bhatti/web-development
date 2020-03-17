import React, { Component } from 'react';
import Stopwatch from "./stopwatch";
class SwHolder extends Component {
  state = {
    total: 1,
    _nextId: 2,
    stopwatch: [
      { _id: 1 }
    ]
  }

  buttonStyle = {
    fontSize: 24,
    height: 40,
    width: 40
  }

  handleAdd = () => {
    const stateModified = this.state;
    stateModified.total++;
    const sw = { _id: stateModified._nextId }
    stateModified._nextId++;
    stateModified.stopwatch.push(sw);

    this.setState(stateModified);
  };

  handleDelete = (stopwatch) => {
    const stateModified = this.state;
    stateModified.total--;
    stateModified.stopwatch = stateModified.stopwatch.filter(sw => sw !== stopwatch);
    this.setState(stateModified);

  };

  render() {
    return (
      <div className="row">
        {this.state.stopwatch.map(sw => <Stopwatch key={sw._id} onCloseClick={() => { this.handleDelete(sw) }} />)}
        <button style={this.buttonStyle} onClick={this.handleAdd} className="btn btn-sm btn-outline-success m-2 p-0 ">+</button>
      </div>);
  }
}

export default SwHolder;