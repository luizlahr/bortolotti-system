import { useCallback } from 'react';
import styled, { createGlobalStyle, css } from 'styled-components';
import theme from '../../../styles/theme';

interface IInput {
  hasFocus: boolean;
  isDirty: boolean;
}

const inputBases = css<IInput>`
  padding: 4px 8px;
  overflow: hidden;

  border-radius: 10px;
  border: 2px solid transparent;

  background-color: ${theme.secondary};
  height: ${theme.inputSizes.regular};

  &::placeholder {
    color: ${theme.textPlaceholder};
  }
`;

const inputFocused = css`
  border-color: ${theme.primary} !important;
  border-right-width: 2px !important;
  box-shadow: none;
`;

export const InputStyles = createGlobalStyle`
  .ll-input {
    border-radius: 10px;
    border-color: rgb(217,217,217);
    border-width: 1px;
    background: #fff;

    &:hover {
      border-color: rgba(0,0,255, 0.5);
    }

    &:focus {
      box-shadow: 0 0 2px 1px rgba(0,0,255,0.3);
      border-color: rgba(0,0,255, 0.5);
    }
  }
`;
