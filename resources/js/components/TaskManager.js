import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Table from "react-bootstrap/Table";
import Container from "react-bootstrap/Container";
import Button from "react-bootstrap/Button";
import Spinner from "react-bootstrap/Spinner";

import Buttons from "./Buttons";
import MyModal from "./Modal";
import '../../css/app.css'

function GetData(url, params, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url + '?' + params, true);
    xhr.onreadystatechange = function(e) {
        if (this.readyState === xhr.DONE) {
            if (this.status === 200) {
                callback(JSON.parse(xhr.responseText));
            } else {
                if (this.status === 404) {
                    callback('');
                } else {
                    console.log('error');
                }
            }
        }
    }
    xhr.send(null);
}

const priorityRussian = {'high': 'Высокий', 'medium': 'Средний','low': 'Низкий'}
const statusRussian = {'completed': 'Выполнена', 'not completed': 'Не выполнена'}

export default class TaskManager extends Component {
    constructor(props){
        super(props);
        console.log('data from component', JSON.parse(this.props.data));
        this.state = {
            tasks: [],
            isHead: false,
            creatable: '',
            headTasksIds: '',
            level: 0,
            button1Value: '',
            button2Value: '',
            showModal: false,
            taskItem: false,
            showSpinner: false,
        }
        this.onChangeList = this.onChangeList.bind(this);
        this.handleModal = this.handleModal.bind(this);
    }

    componentDidMount () {
        const id = this.props.data;
        GetData('http://localhost:8000/api/info/' + id, '', (res) => {
            this.setState({
                isHead: res['isHead'],
                creatable: res['creatable'],
                headTasksIds: res['headTasksIds'],
                showSpinner: true
            });
        });
        GetData('http://localhost:8000/api/tasks/' + id, '', (res) => {
            this.setState({
                tasks: res,
                showSpinner: false
            });
        });
    }

    handleModal(e, task) {
        this.setState({
            showModal: !this.state.showModal,
            showSpinner: true
        });
        if (e) {
            if (e.target.id === 'newTaskButton') {
                this.setState({
                    taskItem: '',
                    showSpinner: false
                });
            } else {
                if (e.target.id === 'updateTask') {
                    task['expirationDate'] = task['date']
                    this.setState({
                        taskItem: task,
                        showSpinner: false
                    });
                }
            }
        }
    }

    onChangeList (value1, value2){
        const id = this.props.data;
        this.setState({
            showSpinner: true
        }, () =>{
            GetData('http://localhost:8000/api/tasks/' + id,
                'time='+value1+'&subordinate='+value2,
                (res) => {
                    this.setState({
                        tasks: res,
                        button1Value: value1,
                        button2Value: value2,
                        showSpinner: false
                    });
                })
            })
        };

    titleColor(date, status) {
        if (status === 'completed')
            return 'green';
        let dateTime = date.split(' ');
        let currentDate = Date.parse(dateTime[0]+'T'+dateTime[1]);
        if ((status === 'not completed')&&(Date.now()>currentDate))
            return 'red';
    }

    taskItem(task){
        return(
            <tr key={task.id}>
                <td>
                    {this.EditButton(task)}
                </td>
                <td className={this.titleColor(task.date, task.status)}>{task.title}</td>
                <td>{priorityRussian[task.priority]}</td>
                <td>{task.date}</td>
                <td>{task.surname + ' ' + task.name}</td>
                <td>{statusRussian[task.status]}</td>
            </tr>
        )
    }

    EditButton(task) {
        if (this.state.button2Value === 'all'){
            return(
                <Button id='updateTask'
                        key={task.id}
                        disabled
                        className='editButton'
                        variant='outline-primary'
                >
                    Редактировать
                </Button>
            )
        } else {
            return(
                <Button id='updateTask'
                        key={task.id}
                        onClick= {(e) => this.handleModal(e, task)}
                        className='editButton'
                        variant='outline-primary'
                >
                    Редактировать
                </Button>
            )
        }
    }

    TaskGrid(tasks){
        if (!tasks) {
            return(
                <tbody>
                    <tr key = {'notFound'}>
                        <td colSpan="6">Данные не найдены!</td >
                    </tr>
                </tbody>
            )
        }

        if (!this.state.button1Value && !this.state.button2Value) {
            return(
                <React.Fragment>
                    <tbody key={1}>
                    {Object.values(tasks).map(task =>
                        this.taskItem(task)
                    )}
                    </tbody>
                </React.Fragment>
            )
        } else {
            if ((this.state.button1Value && this.state.button2Value)) {
                return(
                    <React.Fragment>
                        {Object.keys(tasks).map(key1 =>
                            <tbody key={key1}>

                            <tr key={key1}>
                                <td className="firstGroup" colSpan="6">{key1}</td>
                            </tr>

                            {Object.keys(tasks[key1]).map((key2) =>
                                <React.Fragment key={key2}>
                                    <tr key={key2}>
                                        <td className="secondGroup" colSpan="6">{key2}</td>
                                    </tr>
                                    {Object.values(tasks[key1][key2]).map((task) =>
                                        this.taskItem(task)
                                    )}
                                </React.Fragment>
                            )}
                            </tbody>
                        )}
                    </React.Fragment>
                )

            } else {
                return(
                    <React.Fragment>
                        {Object.keys(tasks).map(key =>
                            <tbody key={key}>
                            <tr key={key}>
                                <td className="firstGroup" colSpan="6">{key}</td>
                            </tr>

                            {Object.values(tasks[key]).map((task) =>
                                this.taskItem(task)
                            )}
                            </tbody>
                        )}
                    </React.Fragment>
                )
            }
        }

    }

    render() {
        const { data } = this.props;
        const { tasks } = this.state;

        return (
            <>
                <Container>
                    { this.state.showModal &&
                        <MyModal
                            showModal={this.state.showModal}
                            handleModal={this.handleModal}

                            onChangeList = {() => this.onChangeList(this.state.button1Value, this.state.button2Value)}
                            button1Value = {this.state.button1Value}
                            button2Value = {this.state.button2Value}

                            taskItem = {this.state.taskItem}
                            headTasksIds = {this.state.headTasksIds}
                            creatable= {this.state.creatable}
                            creator={data}
                        />
                    }

                    <Buttons
                        handleModal={this.handleModal}
                        onChange={this.onChangeList}

                        isHead={this.state.isHead}
                        editable={this.state.editable}
                        data={data}
                    />

                    { this.state.showSpinner &&
                        <Spinner animation="border" role="status">
                            <span className="sr-only">Loading...</span>
                        </Spinner>
                    }

                    <Table bordered hover>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Заголовок</th>
                                <th>Приоритет</th>
                                <th>Дата окончания</th>
                                <th>Ответственный</th>
                                <th>Статус</th>
                            </tr>
                        </thead>

                        {
                            this.TaskGrid(tasks)
                        }

                    </Table>

                </Container>
            </>
        );
    }
}

if (document.getElementById('reactContent')) {
    let data = document.getElementById('reactContent').getAttribute('data');
    ReactDOM.render(<TaskManager data={data} />, document.getElementById('reactContent'));
}
