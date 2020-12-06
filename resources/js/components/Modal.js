import React, {Component, useState} from "react";
import Container from "react-bootstrap/Container";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
import Form from "react-bootstrap/Form";
import DatePicker from "react-datepicker";
import { registerLocale, setDefaultLocale } from  "react-datepicker";
import {ru} from 'date-fns/esm/locale';
import axios from "axios";
import "react-datepicker/dist/react-datepicker.css";



registerLocale('ru', ru)
setDefaultLocale('ru')

export default class MyModal extends Component {
    constructor(props){
        super(props);
        this.state = {
            title: '',
            description: '',
            priority: 'low',
            expirationDate: new Date(),
            responsible_id: props.creator,
            status: 'not completed',
        }
        this.handleTitleChange = this.handleTitleChange.bind(this);
        this.handlePriorityChange = this.handlePriorityChange.bind(this);
        this.handleResponsibleChange = this.handleResponsibleChange.bind(this);
        this.handleDescriptionChange = this.handleDescriptionChange.bind(this);
        this.handleStatusChange = this.handleStatusChange.bind(this);
        this.handleStore = this.handleStore.bind(this);
        this.handleUpdate = this.handleUpdate.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleDateSelect = this.handleDateSelect.bind(this);

    }

    storeValues () {
        const id = this.props.data;
        GetData('http://localhost:8000/api/ishead/' + id, '', (res) => {
            this.setState({ isHead: res });
        });
    }

    handleDateSelect(date){
        this.setState({expirationDate: date})
    }

    handleStore(){
        let dateFormat = require("dateformat");

        let data = new FormData();
        data.append('title', this.state.title);
        data.append('description', this.state.description);
        data.append('priority', this.state.priority);
        data.append('expirationDate', dateFormat(this.state.expirationDate, "dd-mm-yyyy hh:MM:ss"));
        data.append('responsible_id', this.state.responsible_id);
        data.append('creator_id', this.props.creator);
        data.append('status', this.state.status);

        axios({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/task',
            data: data,
            //headers: {'Content-Type': 'multipart/form-data' }
        })
            .then(function (response) {
                //handle success
                console.log(response);
            })
            .catch(err => {console.error(err.response.data);})
            .finally(() => {
                    this.props.onChangeList(this.props.button1Value, this.props.button2Value);
                }
            )
    }

    handleUpdate(){
        let dateFormat = require("dateformat");

        let data = {
            id: this.props.taskItem.id,
            title: this.state.title,
            description: this.state.description,
            priority: this.state.priority,
            expirationDate: dateFormat(this.state.expirationDate, "dd-mm-yyyy hh:MM:ss"),
            responsible_id: this.state.responsible_id,
            creator_id: this.props.creator,
            status: this.state.status,
        }

        axios({
            method: 'put',
            url: 'http://127.0.0.1:8000/api/task/'+ this.props.taskItem.id,
            data: data,
        })
            .then(function (response) {
                console.log(response);
            })
            .catch(err => {console.error(err.response.data);})
            .finally(() => {
                    this.props.onChangeList(this.props.button1Value, this.props.button2Value);
                }
            )
    }

    handleTitleChange(e){
        this.setState({title: e.target.value})
    }

    handleDescriptionChange(e){
        this.setState({description: e.target.value})
    }

    handlePriorityChange(e){
        this.setState({priority: e.target.value})
    }

    handleResponsibleChange(e){
        this.setState({responsible_id: e.target.value})
    }

    handleStatusChange(e){
        this.setState({status: e.target.value})
    }

    handleSubmit(){
        if (this.props.taskItem) {
            this.handleUpdate();
        } else {
            this.handleStore();
        }
        this.props.handleModal();
    }

    componentDidMount() {

        if (this.props.taskItem) {
            let expirationDateFormatted = new Date()
            expirationDateFormatted.setTime(Date.parse(this.props.taskItem.expirationDate.replace(' ', 'T')+'.000+05:00'))

            this.setState({
                title: this.props.taskItem.title,
                description: this.props.taskItem.description,
                priority: this.props.taskItem.priority,
                expirationDate: expirationDateFormatted,
                responsible_id: this.props.taskItem.responsible_id,
                status: this.props.taskItem.status,
            })
            console.log(this.props.taskItem.expirationDate)
        }
    }

    isBlockedInput() {
        if (!this.props.headTasksIds) return false
        return (this.props.headTasksIds.indexOf(parseInt(this.props.taskItem.id)) != -1)
    }

    render() {
        return(
            <>
                <Modal size="lg" show = {this.props.showModal} onHide={this.props.handleModal}>
                    <Modal.Header closeButton>
                        <Modal.Title>Задача</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <Form>
                            <Form.Group controlId="formTitle">
                                <Form.Label>Заголовок</Form.Label>
                                <Form.Control
                                    disabled= {this.isBlockedInput()}
                                    value= {this.state.title}
                                    onChange={this.handleTitleChange}
                                    as="textarea"
                                    rows={2}
                                />
                            </Form.Group>

                            <Form.Group controlId="formDescription">
                                <Form.Label>Описание</Form.Label>
                                <Form.Control
                                    disabled= {this.isBlockedInput()}
                                    value= {this.state.description}
                                    onChange={this.handleDescriptionChange}
                                    as="textarea"
                                    rows={3}
                                />
                            </Form.Group>

                            <Form.Group controlId="formPriority">
                                <Form.Label>Приоритет</Form.Label>
                                <Form.Control
                                    disabled= {this.isBlockedInput()}
                                    value= {this.state.priority}
                                    onChange={this.handlePriorityChange}
                                    as="select"
                                >
                                    <option value='low'>Низкий</option>
                                    <option value='medium'>Средний</option>
                                    <option value='high'>Высокий</option>
                                </Form.Control>
                            </Form.Group>

                            <Form.Group controlId="formExpirationDate">
                                <Form.Label>Дата окончания</Form.Label>
                                <Container bsPrefix = 'padding-left:0px'>
                                    <DatePicker
                                        className="form-control"
                                        readOnly={this.isBlockedInput()}
                                        selected={this.state.expirationDate}
                                        onSelect={date => this.handleDateSelect(date)}
                                        onChange={date => this.handleDateSelect(date)}
                                        timeInputLabel="Время:"
                                        dateFormat="yyyy/MM/dd HH:mm"
                                        showTimeInput
                                    />
                                </Container>
                            </Form.Group>

                            <Form.Group controlId="formResponsible">
                                <Form.Label>Ответственный</Form.Label>
                                <Form.Control
                                    disabled= {this.isBlockedInput()}
                                    value= {this.state.responsible_id}
                                    onChange={this.handleResponsibleChange}
                                    as="select"
                                >
                                    {Object.keys(this.props.creatable).map((id) =>
                                        <option key={id} value={id}>{this.props.creatable[id]}</option>
                                    )}
                                </Form.Control>
                            </Form.Group>

                            <Form.Group controlId="formStatus">
                                <Form.Label>Статус</Form.Label>
                                <Form.Control
                                    value= {this.state.status}
                                    onChange={this.handleStatusChange}
                                    as="select"
                                >
                                    <option value='completed'>Выполнена</option>
                                    <option value='not completed'>Не выполнена</option>
                                </Form.Control>
                            </Form.Group>

                        </Form>
                    </Modal.Body>
                    <Modal.Footer>
                        <Button key = 'closeButton' variant="secondary" onClick={this.props.handleModal}>
                            Закрыть
                        </Button>

                        <Button variant="primary" onClick={this.handleSubmit}>
                            Сохранить
                        </Button>
                    </Modal.Footer>
                </Modal>
            </>
        )
    }
}
