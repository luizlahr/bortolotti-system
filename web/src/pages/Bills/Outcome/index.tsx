import React, { useCallback, useState } from 'react';
import { FiEdit2, FiTrash2 } from 'react-icons/fi';

import { Container } from 'pages/layout/Pages/styles';

import Span from 'components/Span';
import Table, { TableActions } from 'components/Table';
import { PageHeader } from 'pages/layout/Pages';
import Button from 'components/Button';
import OutcomeForm from 'pages/Bills/Outcome/OutcomeForm';
import { OnSearchProps } from 'components/Form/Search';

interface ICategory {
  id: number;
  name: string;
}

interface ICustomer {
  id: number;
  name: string;
}

interface IBills {
  key: number;
  description: number;
  value: number;
  category_id: number;
  customer_id: number;
  category: ICategory;
  customer: ICustomer;
  rest: number;
}

const Income: React.FC = () => {
  const [showForm, setShowForm] = useState(false);

  const columns = [
    {
      key: 'due_date',
      title: 'Vencimento',
      dataIndex: 'due_date',
    },
    {
      key: 'description',
      title: 'Descrição',
      dataIndex: 'description',
      render: (text: string, record: IBills) => {
        return (
          <Span direction="vertical">
            {text}
            <small>
              <strong>Sacado</strong>: {record.customer.name}
            </small>
          </Span>
        );
      },
    },
    {
      key: 'category_id',
      title: 'Categoria',
      dataIndex: 'category_id',
      render: (text: string, record: IBills) =>
        `${text} - ${record.category.name}`,
    },
    {
      key: 'value',
      title: 'Valor',
      dataIndex: 'value',
      render: (text: string, record: IBills) => `R$ ${text}`,
    },
    {
      key: 'rest',
      title: 'Saldo',
      dataIndex: 'rest',
      render: (text: string, record: IBills) => `R$ ${text}`,
    },
    {
      key: 'actions',
      width: '100px',
      render: (text: string, record: IBills, index: number) => (
        <TableActions>
          <Button title="Editar">
            <FiEdit2 size={16} />
          </Button>
          <Button title="Excluir">
            <FiTrash2 size={16} />
          </Button>
        </TableActions>
      ),
    },
  ];

  const incomeData = [
    {
      key: 1,
      description: 'Aluguel 2/12',
      category_id: 2,
      customer_id: 1,
      value: 50,
      rest: 40,
      due_date: '10/05/2022',
      category: {
        id: 2,
        name: 'Aluguel',
      },
      customer: {
        id: 1,
        name: 'Luiz Lahr',
      },
    },
    {
      key: 2,
      description: 'Aluguel 3/12',
      category_id: 1,
      customer_id: 1,
      value: 123.2,
      rest: 0,
      due_date: '10/06/2022',
      category: {
        id: 1,
        name: 'Aluguel',
      },
      customer: {
        id: 1,
        name: 'Lucio Bortolotti',
      },
    },
  ];
  const handleSearch = () => {};
  // const handleSearch: OnSearchProps = useCallback((value): void => {
  //   console.log(value);
  // }, []);

  const handleAdd = useCallback((): void => {
    setShowForm(true);
  }, []);

  const handleEdit = useCallback((): void => {
    setShowForm(true);
  }, []);

  const handleOnClose = useCallback((): void => {
    setShowForm(false);
  }, []);

  return (
    <Container>
      <PageHeader
        title="Contas a Pagar"
        onSearch={handleSearch}
        onAdd={handleAdd}
      />
      <Table columns={columns} dataSource={incomeData} />
      <OutcomeForm visible={showForm} onClose={handleOnClose} />
    </Container>
  );
};

export default Income;
