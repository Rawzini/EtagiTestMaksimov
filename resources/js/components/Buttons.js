import React, { Component } from 'react';
import Dropdown from "react-bootstrap/Dropdown";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Button from "react-bootstrap/Button";

function GetData(url, params, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url + '?' + params, true);
    xhr.onreadystatechange = function(e) {
        if (this.readyState === xhr.DONE) {
            if (this.status === 200) {
                callback(JSON.parse(xhr.responseText));
            } else {
                console.log('error');
            }
        }
    }
    xhr.send(null);
}

export default class Buttons extends Component {
    constructor(props){
        super(props);
        //console.log('data from component', JSON.parse(this.props.data));
        this.state = {
            tasks: [],
            button1: 'За все время',
            button1value: '',
            button2: 'Мои задачи',
            button2value: '',
        }

        this.onButton1Click = this.onButton1Click.bind(this);
        this.onButton2Click = this.onButton2Click.bind(this);
    }



    onButton1Click (e, value) {
        this.setState({
                button1: e.target.textContent,
                button1value: value},
            () => {
                this.props.onChange(this.state.button1value, this.state.button2value);
        });

    }

    onButton2Click (e, value) {
        this.setState({
            button2: e.target.textContent,
            button2value: value},
            () => {
                this.props.onChange(this.state.button1value, this.state.button2value);
        })

    }

    isActive1 (value){
        return 'dropdown-item ' + ((value===this.state.button1) ?'active':'default');
    }

    isActive2 (value){
        return 'dropdown-item ' + ((value===this.state.button2) ?'active':'default');
    }

    Button1(){
        return(
            <Dropdown className ="buttons">
                <Dropdown.Toggle variant="success" id="dropdown-basic">
                    {this.state.button1}
                </Dropdown.Toggle>

                <Dropdown.Menu>
                    <Dropdown.Item className={this.isActive1('На сегодня')} onClick={(e) => this.onButton1Click(e, '1')} >На сегодня</Dropdown.Item>
                    <Dropdown.Item className={this.isActive1('На неделю')} onClick={(e) => this.onButton1Click(e, '7')}>На неделю</Dropdown.Item>
                    <Dropdown.Item className={this.isActive1('Все актуальные')} onClick={(e) => this.onButton1Click(e, '0')}>Все актуальные</Dropdown.Item>
                    <Dropdown.Item className={this.isActive1('За все время')} onClick={(e) => this.onButton1Click(e, '')}>За все время</Dropdown.Item>
                </Dropdown.Menu>
            </Dropdown>
        )
    }

    Button2(){
        return(
            <Dropdown className ="buttons">
                <Dropdown.Toggle variant="success" id="dropdown-basic">
                    {this.state.button2}
                </Dropdown.Toggle>

                <Dropdown.Menu>
                    <Dropdown.Item className={this.isActive2('Мои задачи')} onClick={(e) => this.onButton2Click(e, '')}>Мои задачи</Dropdown.Item>
                    <Dropdown.Item className={this.isActive2('Задачи подчиненных')} onClick={(e) => this.onButton2Click(e, 'subordinates')}>Задачи подчиненных</Dropdown.Item>
                    <Dropdown.Item className={this.isActive2('Все доступные задачи')} onClick={(e) => this.onButton2Click(e, 'all')}>Все доступные задачи</Dropdown.Item>
                </Dropdown.Menu>
            </Dropdown>
        )
    }

    ButtonNewTask(){
        return <Button id='newTaskButton' onClick={this.props.handleModal} className ="buttons">Добавить задачу</Button>
    }

    render() {
        return (
            <>
                <Container>
                    <Row>
                        <Col md="auto">
                            {this.Button1()}
                        </Col>

                        <Col md="auto">
                            {this.props.isHead && this.Button2()}
                        </Col>

                        <Col sm ></Col>
                            {this.ButtonNewTask()}
                        <Col md="auto">

                        </Col>
                    </Row>
                </Container>
            </>
        )
    }
}
